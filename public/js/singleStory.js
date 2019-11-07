 //For the quill toolbar for comments
 var quill = new Quill('#add-my-comment', {
    modules: {
        toolbar: [
            [{
                header: [1, 2, false]
            }, 'blockquote', 'code-block'],
            ['bold', 'italic', 'underline'],
        ]
    },
    placeholder: 'Leave a Comment...',
    theme: 'bubble'  // or 'snow'
});

const setPlaceholder = () =>{

}

$('div.leave-comment').on('click', function () {
    $('div.leave-comment__add-my-comment').toggle('slow');
});

const addSummary = (data) =>{
    const summary = data.summary;
    const pSummary = document.getElementById('summary-text');

    if (summary && summary.trim() == '') {
        pSummary.innerHTML = summary;
        pSummary.classList.remove('no-summary');
    } else{
        pSummary.innerHTML = 'No summary to this story.';
        pSummary.classList.add('no-summary');
    }
}

$('a.btn-see-summary').on('click', function() {
    const divSumm = document.querySelector('div.summary-section');
    if (divSumm) {
        $(divSumm).toggleClass('active');
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const story = document.getElementById('story-body').textContent;
    // console.log('story', story);
    
    //Make fetch request for the story summary
    const url = 'http://3.86.111.67:5000/api/summarize';
    bodyData = {
        "story": story
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(bodyData)
    }).then(resp=> {
        console.log(resp);
        return resp.json();
    })
    .then(addSummary)
    .catch(err => console.error(err));
});