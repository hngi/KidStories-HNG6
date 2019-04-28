// var updateStoryStats = {
//     Like: function (storyId) {
//         document.querySelector('#likes-count-' + storyId).textContent++;
//     },

//     Unlike: function(storyId) {
//         document.querySelector('#likes-count-' + storyId).textContent--;
//     }
// };


// var toggleButtonText = {
//     Like: function(button) {
//         button.textContent = "Unlike";
//     },

//     Unlike: function(button) {
//         button.textContent = "Like";
//     }
// };

var react = function (event) {
    console.log(event)
    // var storyId = event.target.dataset.storyId;
    // var action = event.target.textContent;
    // toggleButtonText[action](event.target);
    // updateStoryStats[action](storyId);
    // axios.post('/stories/' + storyId + '/reactions/like',
    //     { action: action });
};

// Echo.channel('KidsStories')
//             .listen('Reaction', function(event) {
//                 console.log(event);
//                 var action = event.action;
//                 updateStoryStats[action](event.storyId);
//             })

// $('.like').on('click', function(){
//     console.log(event)
// })
