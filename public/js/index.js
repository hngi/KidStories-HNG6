var updateReactionStats = function (storyId, likeCount, dislikeCount, action) {
      document.querySelector('#likes-count-' + storyId).innerHTML = likeCount;
      document.querySelector('#dislikes-count-' + storyId).innerHTML = dislikeCount;

      if (action == "Added like") {
        document.querySelector('#fav-like-' + storyId).className += " fav-green";
      } else if (action == "Removed like") {
        document.querySelector('#fav-like-' + storyId).classList.remove('fav-green');
      } else if (action == "Changed to like") {
        document.querySelector('#fav-like-' + storyId).className += " fav-green";
        document.querySelector('#fav-dislike-' + storyId).classList.remove('fav-red');
      } else if (action == "Added dislike") {
        document.querySelector('#fav-dislike-' + storyId).className += " fav-red";
      }else if (action == "Removed dislike") {
        document.querySelector('#fav-dislike-' + storyId).classList.remove('fav-red');
      }else if (action == "Changed to dislike") {
        document.querySelector('#fav-like-' + storyId).classList.remove("fav-green");
        document.querySelector('#fav-dislike-' + storyId).className += ' fav-red';
      }
};

var react = async function(event) {
  event.preventDefault();
  var text = event.target.id;
  var storyId = event.target.dataset.storyId;
  var favId = event.target.dataset.favId;
  let action = '';
  if (text === "fav-like-"+storyId) {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like');
  } else {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/dislike');
  }
  updateReactionStats(storyId, action.data.likes_count, action.data.dislikes_count, action.data.action);
};

var bookmark = async function(event){
  event.preventDefault();
  var storyId = event.target.dataset.storyId;
  let action = '';
  var favId = event.target.dataset.favId;
  
  action = await axios.post('/api/v1/bookmarks/stories/' + storyId);
  updateBookmarkIcon(storyId, action.data.message, favId);
}

var updateBookmarkIcon = function (storyId, message, favId) {

  if (message == "Created") {
    document.querySelector('#bookmark-' + storyId).className += " bookmark-blue";
  } else if (message == "Removed") {
    document.querySelector('#bookmark-' + storyId).classList.remove('bookmark-blue');
  }

  if (favId) {
    document.querySelector('#bookmark-div-' + storyId).remove();
  }
};