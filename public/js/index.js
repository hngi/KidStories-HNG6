var react = async function(event) {
  event.preventDefault();
  var text = event.target.textContent;
  //console.log(text)
  var storyId = event.target.dataset.storyId;
  var token = $('.hidden').html;
  console.log(token);
  if (text === "Like") {
      console.log(1)
      const action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like', {
          action: text,
          header: {

          }
      });
      console.log(action)
  } else {
      const action = await axios.post('/api/v1/stories/' + storyId + '/reactions/dislike', {
          action: text
      });
  }

};