/**
 * ChangeMakers Video Playback
 * Ensures videos autoplay on all devices
 */
document.addEventListener('DOMContentLoaded', function() {
	const videos = document.querySelectorAll('.changemakers-hero__video, .changemakers-video-strip__video');

	videos.forEach(function(video) {
		// Ensure proper attributes for mobile autoplay
		video.muted = true;
		video.playsInline = true;

		// Attempt to play
		const playPromise = video.play();

		if (playPromise !== undefined) {
			playPromise.catch(function() {
				// Autoplay was prevented - retry on first user interaction
				const playOnInteraction = function() {
					video.play();
					document.removeEventListener('touchstart', playOnInteraction);
					document.removeEventListener('click', playOnInteraction);
				};

				document.addEventListener('touchstart', playOnInteraction, { once: true });
				document.addEventListener('click', playOnInteraction, { once: true });
			});
		}
	});
});
