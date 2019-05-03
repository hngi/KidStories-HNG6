var updateReactionStats = function (storyId, likeCount, dislikeCount, action) {
      document.querySelector('#likes-count-' + storyId).innerHTML = likeCount;
      document.querySelector('#dislikes-count-' + storyId).innerHTML = dislikeCount;

      if (action == "Added like") {
        document.querySelector('#fav-like').className += " fav-green";
      } else if (action == "Removed like") {
        document.querySelector('#fav-like').classList.remove('fav-green');
      } else if (action == "Changed to like") {
        document.querySelector('#fav-like').className += " fav-green";
        document.querySelector('#fav-dislike').classList.remove('fav-red');
      } else if (action == "Added dislike") {
        document.querySelector('#fav-dislike').className += " fav-red";
      }else if (action == "Removed dislike") {
        document.querySelector('#fav-dislike').classList.remove('fav-red');
      }else if (action == "Changed to dislike") {
        document.querySelector('#fav-like').classList.remove("fav-green");
        document.querySelector('#fav-dislike').className += ' fav-red';
      }
};

var react = async function(event) {
  event.preventDefault();
  var text = event.target.id;
  var storyId = event.target.dataset.storyId;
  let action = '';
  if (text === "fav-like") {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like');
  } else {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/dislike');
  }
  updateReactionStats(storyId, action.data.likes_count, action.data.dislikes_count, action.data.action);
};
