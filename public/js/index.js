var updateReactionStats = function (storyId, likeCount, dislikeCount) {
      document.querySelector('#likes-count-' + storyId).innerHTML = likeCount;
      document.querySelector('#dislikes-count-' + storyId).innerHTML = dislikeCount;
};

var react = async function(event) {
  event.preventDefault();
  var text = event.target.textContent;
  var storyId = event.target.dataset.storyId;
  let action = '';
  if (text === "Like") {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like');
  } else {
      action = await axios.post('/api/v1/stories/' + storyId + '/reactions/dislike');
  }

  updateReactionStats(storyId, action.data.likes_count, action.data.dislikes_count);
};