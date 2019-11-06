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
})