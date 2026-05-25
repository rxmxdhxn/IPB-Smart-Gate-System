"""
RTSP to MJPEG Proxy Server
Converts RTSP stream from TP-Link Tapo camera to browser-compatible MJPEG over HTTP.

Usage:
    pip install opencv-python flask flask-cors
    python rtsp_proxy.py

The proxy will be available at:
    http://127.0.0.1:8002/video_feed   (MJPEG stream for <img> tag)
    http://127.0.0.1:8002/snapshot      (single JPEG frame for OCR)
    http://127.0.0.1:8002/status        (connection status)

RTSP URL: rtsp://tanjiro:12345678@10.34.81.189:554/stream1
"""

import cv2
import threading
import time
from flask import Flask, Response, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# ===== Configuration =====
RTSP_URL = "rtsp://tanjiro:12345678@10.34.81.189:554/stream1"
PROXY_PORT = 8002
FRAME_WIDTH = 1280
FRAME_HEIGHT = 720
FPS_LIMIT = 15  # Limit FPS to reduce bandwidth
# ==========================


class RTSPStream:
    """Thread-safe RTSP stream reader with automatic reconnection."""

    def __init__(self, rtsp_url):
        self.rtsp_url = rtsp_url
        self.frame = None
        self.lock = threading.Lock()
        self.running = False
        self.connected = False
        self.thread = None

    def start(self):
        if self.running:
            return
        self.running = True
        self.thread = threading.Thread(target=self._capture_loop, daemon=True)
        self.thread.start()
        print(f"[INFO] RTSP capture thread started for: {self.rtsp_url}")

    def stop(self):
        self.running = False
        if self.thread:
            self.thread.join(timeout=5)

    def _capture_loop(self):
        while self.running:
            cap = cv2.VideoCapture(self.rtsp_url)
            cap.set(cv2.CAP_PROP_BUFFERSIZE, 1)

            if not cap.isOpened():
                print("[WARN] Cannot connect to RTSP stream. Retrying in 5s...")
                self.connected = False
                time.sleep(5)
                continue

            self.connected = True
            print("[INFO] Connected to RTSP stream.")

            while self.running:
                ret, frame = cap.read()
                if not ret:
                    print("[WARN] Lost RTSP connection. Reconnecting...")
                    self.connected = False
                    break

                # Resize if needed
                if FRAME_WIDTH and FRAME_HEIGHT:
                    frame = cv2.resize(frame, (FRAME_WIDTH, FRAME_HEIGHT))

                with self.lock:
                    self.frame = frame

                # Limit frame rate
                time.sleep(1.0 / FPS_LIMIT)

            cap.release()
            time.sleep(2)  # Wait before reconnecting

    def get_frame(self):
        with self.lock:
            return self.frame.copy() if self.frame is not None else None

    def get_jpeg(self, quality=80):
        frame = self.get_frame()
        if frame is None:
            return None
        _, jpeg = cv2.imencode('.jpg', frame, [cv2.IMWRITE_JPEG_QUALITY, quality])
        return jpeg.tobytes()


# Global stream instance
stream = RTSPStream(RTSP_URL)


def generate_mjpeg():
    """Generator that yields MJPEG frames."""
    while True:
        jpeg = stream.get_jpeg(quality=75)
        if jpeg is None:
            # Send a placeholder frame or wait
            time.sleep(0.1)
            continue

        yield (
            b'--frame\r\n'
            b'Content-Type: image/jpeg\r\n\r\n' + jpeg + b'\r\n'
        )
        time.sleep(1.0 / FPS_LIMIT)


@app.route('/video_feed')
def video_feed():
    """MJPEG stream endpoint - use in <img src="http://127.0.0.1:8002/video_feed">"""
    return Response(
        generate_mjpeg(),
        mimetype='multipart/x-mixed-replace; boundary=frame'
    )


@app.route('/snapshot')
def snapshot():
    """Single JPEG frame endpoint - used by OCR to grab current frame."""
    jpeg = stream.get_jpeg(quality=90)
    if jpeg is None:
        return jsonify({"error": "No frame available"}), 503
    return Response(jpeg, mimetype='image/jpeg')


@app.route('/status')
def status():
    """Stream status endpoint."""
    return jsonify({
        "connected": stream.connected,
        "rtsp_url": RTSP_URL.replace("tanjiro:12345678", "***:***"),
        "resolution": f"{FRAME_WIDTH}x{FRAME_HEIGHT}",
        "fps_limit": FPS_LIMIT,
    })


if __name__ == '__main__':
    print("=" * 50)
    print("  RTSP to MJPEG Proxy Server")
    print(f"  RTSP Source: {RTSP_URL}")
    print(f"  Proxy URL:   http://127.0.0.1:{PROXY_PORT}/video_feed")
    print(f"  Snapshot:    http://127.0.0.1:{PROXY_PORT}/snapshot")
    print(f"  Status:      http://127.0.0.1:{PROXY_PORT}/status")
    print("=" * 50)

    stream.start()
    app.run(host='0.0.0.0', port=PROXY_PORT, threaded=True)
