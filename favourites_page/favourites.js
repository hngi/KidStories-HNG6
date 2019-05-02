$(function() {
	// toastr config
	toastr.options = {
		closeButton: true,
		preventDuplicates: true,
		newestOnTop: true
	};

	// Like stories
	$(".like").on("click", function(e) {
		e.preventDefault();
		// If already liked, do nothing
		if ($(this).hasClass("liked")) {
			$(this).removeClass("liked");
		} else {
			if (
				$(this)
					.next()
					.hasClass("disliked")
			) {
				$(this)
					.next()
					.removeClass("disliked");
			}
			$(this).addClass("liked");
			// display notification
			toastr.info("Story liked");
		}
	});

	// Dislike stories
	$(".dislike").on("click", function(e) {
		e.preventDefault();
		// If already disliked, do nothing
		if ($(this).hasClass("disliked")) {
			$(this).removeClass("disliked");
		} else {
			if (
				$(this)
					.prev()
					.hasClass("liked")
			) {
				$(this)
					.prev()
					.removeClass("liked");
			}
			$(this).addClass("disliked");
			toastr.info("Story disliked");
		}
	});

	// Bookmark stories
	$(".bookmark").on("click", function(e) {
		e.preventDefault();
		if ($(this).hasClass("bookmarked")) {
			$(this).removeClass("bookmarked");
			toastr.info("Bookmark removed");
		} else {
			$(this).addClass("bookmarked");
			toastr.info("Story bookmarked");
		}
	});
});
