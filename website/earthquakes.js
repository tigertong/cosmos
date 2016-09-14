var data = [
	{ value: 4.5, latitude: -7.789, longitude: -74.622  },
	{ value: 2.6, latitude: 37.925, longitude: -77.987 },
	{ value: 4.8, latitude: 38.301, longitude: 141.976 },
	{ value: 2.8, latitude: 32.100, longitude: -115.230 },
	{ value: 5.4, latitude: 48.906, longitude: 154.794 },
	{ value: 4.6, latitude: 39.958, longitude: 143.264 },
	{ value: 5.9, latitude: 40.309, longitude: 142.901 },
	{ value: 4.2, latitude: -17.544, longitude: -178.757 },
	{ value: 2.9, latitude: 63.185, longitude: -148.103 },
	{ value: 2.6, latitude: 61.430, longitude: -151.244 },
	{ value: 2.5, latitude: 59.767, longitude: -153.581 },
	{ value: 4.9, latitude: -12.217, longitude: 165.844 },
	{ value: 4.9, latitude: 40.313, longitude: 143.026 },
	{ value: 4.6, latitude: 28.309, longitude: 54.864 },
	{ value: 5.5, latitude: 40.288, longitude: 143.174 },
	{ value: 4.8, latitude: -5.077, longitude: 129.461 },
	{ value: 4.2, latitude: -11.253, longitude: -77.197 },
	{ value: 5.6, latitude: 40.122, longitude: 143.331 },
	{ value: 3.0, latitude: 58.546, longitude: -150.750 },
	{ value: 6.0, latitude: 40.221, longitude: 143.050 },
	{ value: 5.5, latitude: 40.305, longitude: 143.180 },
	{ value: 5.2, latitude: 40.403, longitude: 142.034 },
	{ value: 6.6, latitude: 40.288, longitude: 142.727 },
	{ value: 5.6, latitude: -20.732, longitude: 169.724 },
	{ value: 2.7, latitude: 45.794, longitude: -122.623 },
	{ value: 3.8, latitude: 36.895, longitude: -104.769 },
	{ value: 2.9, latitude: 51.766, longitude: -171.551 },
	{ value: 2.8, latitude: 32.158, longitude: -115.258 },
	{ value: 3.8, latitude: 61.242, longitude: -147.043 },
	{ value: 2.7, latitude: 61.180, longitude: -147.086 },
	{ value: 2.6, latitude: 61.201, longitude: -147.100 },
	{ value: 5.2, latitude: 18.220, longitude: 119.340 },
	{ value: 3.0, latitude: 18.117, longitude: -64.376 },
	{ value: 3.0, latitude: 18.937, longitude: -67.734 },
	{ value: 3.0, latitude: 51.691, longitude: -171.333 },
	{ value: 4.9, latitude: 7.484, longitude: -36.939 },
	{ value: 4.4, latitude: 5.265, longitude: -82.537 },
	{ value: 4.6, latitude: 35.465, longitude: 140.850 },
	{ value: 4.1, latitude: 14.842, longitude: -95.271 },
	{ value: 3.2, latitude: 19.226, longitude: -64.788 },
	{ value: 4.7, latitude: -20.562, longitude: -179.001 },
	{ value: 3.7, latitude: 52.045, longitude: -171.072 },
	{ value: 3.0, latitude: 56.252, longitude: -157.674 },
	{ value: 2.8, latitude: 31.144, longitude: -115.390 },
	{ value: 4.3, latitude: 51.811, longitude: -171.587 },
	{ value: 4.6, latitude: 34.204, longitude: 135.559 },
	{ value: 4.4, latitude: 36.401, longitude: 70.511 },
	{ value: 5.1, latitude: -56.308, longitude: -26.820 },
	{ value: 3.5, latitude: 20.171, longitude: -155.486 },
	{ value: 7.3, latitude: -21.559, longitude: -179.369 },
	{ value: 2.9, latitude: 59.728, longitude: -150.681 },
	{ value: 4.9, latitude: -54.075, longitude: -1.551 },
	{ value: 2.5, latitude: 51.829, longitude: -174.413 },
	{ value: 5.1, latitude: -54.041, longitude: -1.971 },
	{ value: 5.1, latitude: 36.383, longitude: 82.528 },
	{ value: 3.2, latitude: 19.332, longitude: -155.177 },
	{ value: 4.7, latitude: 39.826, longitude: 141.996 },
	{ value: 3.5, latitude: 63.263, longitude: -151.442 },
	{ value: 5.5, latitude: -14.848, longitude: -177.812 },
	{ value: 2.9, latitude: 40.463, longitude: -125.863 },
	{ value: 2.6, latitude: 32.066, longitude: -115.120 },
	{ value: 4.1, latitude: 49.573, longitude: -127.182 },
	{ value: 4.9, latitude: 3.363, longitude: 126.662 },
	{ value: 2.6, latitude: 17.680, longitude: -67.479 },
	{ value: 2.8, latitude: 18.202, longitude: -67.101 },
	{ value: 3.5, latitude: 33.633, longitude: -117.839 },
	{ value: 5.1, latitude: 19.563, longitude: -78.008 },
	{ value: 4.4, latitude: 35.819, longitude: 25.640 },
	{ value: 6.2, latitude: 36.289, longitude: 141.308 },
	{ value: 6.0, latitude: -35.430, longitude: -177.878 },
	{ value: 2.8, latitude: 32.186, longitude: -115.258 },
	{ value: 4.4, latitude: 21.627, longitude: 143.005 },
	{ value: 4.5, latitude: 59.132, longitude: -138.121 },
	{ value: 4.1, latitude: 59.902, longitude: -151.823 },
	{ value: 6.1, latitude: 53.138, longitude: 173.022 },
	{ value: 5.3, latitude: -6.231, longitude: 103.611 },
	{ value: 4.1, latitude: 33.953, longitude: -117.076 },
	{ value: 3.1, latitude: 61.322, longitude: -147.009 },
	{ value: 5.6, latitude: -35.133, longitude: -179.049 },
	{ value: 2.7, latitude: 38.805, longitude: -122.815 },
	{ value: 4.5, latitude: 36.451, longitude: 70.367 },
	{ value: 4.6, latitude: 0.755, longitude: 100.034 },
	{ value: 4.6, latitude: 4.642, longitude: 126.366 },
	{ value: 4.9, latitude: -18.205, longitude: 167.573 },
	{ value: 2.6, latitude: 17.980, longitude: -66.837 },
	{ value: 5.9, latitude: -32.734, longitude: -71.613 },
	{ value: 3.0, latitude: 61.640, longitude: -150.048 },
	{ value: 5.0, latitude: 37.203, longitude: 22.012 },
	{ value: 2.7, latitude: 38.569, longitude: -88.302 },
	{ value: 2.5, latitude: 33.598, longitude: -86.566 },
	{ value: 2.6, latitude: 33.620, longitude: -86.611 },
	{ value: 3.4, latitude: 40.558, longitude: -127.387 },
	{ value: 2.5, latitude: 52.182, longitude: -173.564 },
	{ value: 4.5, latitude: -24.368, longitude: 179.901 },
	{ value: 3.0, latitude: 33.595, longitude: -86.618 },
	{ value: 4.8, latitude: 26.966, longitude: 127.348 },
	{ value: 2.8, latitude: 63.371, longitude: -148.980 },
	{ value: 4.7, latitude: -37.204, longitude: -73.521 },
	{ value: 2.8, latitude: 52.262, longitude: -172.032 },
	{ value: 4.0, latitude: 32.105, longitude: -115.175 },
	{ value: 4.4, latitude: 51.222, longitude: -175.989 },
	{ value: 2.7, latitude: 53.728, longitude: -165.974 },
	{ value: 2.9, latitude: 40.442, longitude: -125.901 },
	{ value: 5.0, latitude: 34.409, longitude: 23.704 },
	{ value: 2.9, latitude: 57.284, longitude: -156.780 },
	{ value: 2.5, latitude: 57.294, longitude: -156.785 },
	{ value: 3.8, latitude: 51.159, longitude: -174.906 },
	{ value: 4.1, latitude: -4.671, longitude: 143.938 },
	{ value: 4.7, latitude: 38.720, longitude: 142.343 },
	{ value: 2.6, latitude: 36.902, longitude: -104.848 },
	{ value: 3.6, latitude: 35.730, longitude: -121.109 },
	{ value: 3.2, latitude: 53.514, longitude: -163.230 },
	{ value: 5.0, latitude: 35.201, longitude: 141.263 },
	{ value: 4.8, latitude: -6.907, longitude: 143.868 },
	{ value: 5.2, latitude: -6.879, longitude: 143.932 },
	{ value: 2.7, latitude: 52.098, longitude: -171.693 },
	{ value: 2.5, latitude: 32.797, longitude: -100.842 },
	{ value: 3.1, latitude: 52.054, longitude: -171.566 },
	{ value: 2.5, latitude: 53.564, longitude: -163.669 },
	{ value: 2.5, latitude: 36.428, longitude: -117.844 },
	{ value: 2.5, latitude: 37.042, longitude: -104.813 },
	{ value: 4.0, latitude: 36.943, longitude: -104.756 },
	{ value: 5.7, latitude: 5.633, longitude: -77.502 },
	{ value: 5.0, latitude: 5.635, longitude: -77.534 },
	{ value: 3.3, latitude: 58.308, longitude: -153.960 },
	{ value: 2.8, latitude: 51.743, longitude: -171.288 },
	{ value: 2.6, latitude: 36.975, longitude: -104.766 },
	{ value: 3.4, latitude: 36.976, longitude: -104.849 },
	{ value: 3.0, latitude: 51.958, longitude: -171.428 },
	{ value: 4.2, latitude: 11.383, longitude: -86.708 },
	{ value: 3.5, latitude: 53.382, longitude: -163.557 },
	{ value: 5.0, latitude: 35.694, longitude: 143.323 },
	{ value: 6.2, latitude: -3.638, longitude: 144.160 },
	{ value: 2.6, latitude: 63.707, longitude: -148.513 },
	{ value: 3.0, latitude: 51.907, longitude: -171.509 },
	{ value: 4.4, latitude: 6.892, longitude: -76.754 },
	{ value: 2.6, latitude: 52.102, longitude: -171.464 },
	{ value: 5.0, latitude: -6.487, longitude: 103.636 },
	{ value: 4.9, latitude: 36.571, longitude: 140.924 },
	{ value: 2.8, latitude: 38.804, longitude: -122.805 },
	{ value: 3.0, latitude: 38.804, longitude: -122.805 },
	{ value: 4.7, latitude: 42.663, longitude: 142.424 },
	{ value: 2.9, latitude: 52.022, longitude: -171.419 },
	{ value: 2.6, latitude: 19.203, longitude: -155.727 },
	{ value: 3.5, latitude: 58.430, longitude: -153.168 },
	{ value: 3.0, latitude: 19.559, longitude: -66.283 },
	{ value: 3.3, latitude: 35.629, longitude: -97.244 },
	{ value: 4.6, latitude: 35.538, longitude: 141.123 },
	{ value: 3.4, latitude: 32.822, longitude: -100.871 },
	{ value: 3.8, latitude: 52.772, longitude: -168.272 },
	{ value: 2.6, latitude: 61.588, longitude: -151.034 },
	{ value: 4.5, latitude: 14.771, longitude: -91.729 },
	{ value: 4.2, latitude: 50.781, longitude: -129.947 },
	{ value: 2.7, latitude: 32.688, longitude: -100.863 },
	{ value: 2.6, latitude: 32.787, longitude: -100.858 },
	{ value: 3.6, latitude: 54.263, longitude: -159.682 },
	{ value: 3.2, latitude: 18.161, longitude: -67.891 },
	{ value: 2.9, latitude: 32.176, longitude: -115.345 },
	{ value: 2.6, latitude: 32.217, longitude: -115.329 },
	{ value: 5.0, latitude: 5.039, longitude: 127.411 },
	{ value: 4.8, latitude: -30.626, longitude: -178.094 },
	{ value: 5.1, latitude: 23.738, longitude: 122.821 },
	{ value: 2.9, latitude: 51.669, longitude: -171.511 },
	{ value: 4.7, latitude: -13.901, longitude: -76.037 },
	{ value: 4.6, latitude: -9.870, longitude: 117.758 },
	{ value: 2.8, latitude: 32.810, longitude: -100.892 },
	{ value: 6.0, latitude: -18.186, longitude: 167.874 },
	{ value: 2.6, latitude: 18.488, longitude: -66.929 },
	{ value: 3.0, latitude: 41.856, longitude: -126.035 },
	{ value: 2.7, latitude: 32.892, longitude: -100.848 },
	{ value: 3.0, latitude: 52.129, longitude: -171.676 },
	{ value: 3.4, latitude: 51.860, longitude: -173.208 },
	{ value: 2.5, latitude: 32.887, longitude: -100.807 },
	{ value: 3.1, latitude: 52.081, longitude: -172.032 },
	{ value: 2.8, latitude: 52.637, longitude: -169.510 },
	{ value: 4.6, latitude: 34.819, longitude: 89.862 },
	{ value: 3.3, latitude: 52.714, longitude: -169.718 },
	{ value: 4.7, latitude: -13.363, longitude: -76.311 },
	{ value: 4.4, latitude: 32.874, longitude: -100.804 },
	{ value: 3.2, latitude: 51.993, longitude: -171.597 },
	{ value: 4.6, latitude: 35.510, longitude: 140.013 },
	{ value: 2.5, latitude: 32.212, longitude: -115.339 },
	{ value: 4.4, latitude: 39.815, longitude: 15.274 },
	{ value: 2.6, latitude: 58.325, longitude: -133.474 },
	{ value: 4.8, latitude: -26.307, longitude: -70.342 },
	{ value: 2.7, latitude: 52.015, longitude: -171.478 },
	{ value: 4.8, latitude: 3.524, longitude: 126.845 },
	{ value: 4.4, latitude: 51.916, longitude: -171.726 },
	{ value: 4.6, latitude: -10.422, longitude: 123.908 },
	{ value: 4.5, latitude: -43.600, longitude: 172.760 },
	{ value: 4.7, latitude: 41.291, longitude: 142.794 },
	{ value: 2.9, latitude: 58.283, longitude: -133.568 },
	{ value: 3.6, latitude: 50.668, longitude: -177.013 },
	{ value: 4.6, latitude: 28.108, longitude: -112.159 },
	{ value: 4.4, latitude: 19.830, longitude: -66.541 },
	{ value: 2.6, latitude: 58.339, longitude: -133.496 },
	{ value: 4.8, latitude: 48.445, longitude: 154.350 },
	{ value: 5.0, latitude: -8.771, longitude: 67.517 },
	{ value: 3.1, latitude: 61.567, longitude: -146.621 },
	{ value: 2.9, latitude: 51.997, longitude: -171.499 },
	{ value: 2.9, latitude: 52.015, longitude: -171.512 }
];