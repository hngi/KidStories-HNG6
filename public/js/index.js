var react = async function(event) {
  event.preventDefault();
  var text = event.target.textContent;
  //console.log(text)
  var storyId = event.target.dataset.storyId;
  var token = $('.hidden').html;

  if (text === "Like") {
      const action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like');
      console.log(action)
  } else {
      const action = await axios.post('/api/v1/stories/' + storyId + '/reactions/dislike');
      console.log(action)
  }

};