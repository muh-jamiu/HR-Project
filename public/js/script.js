var body_ = document.getElementById("body_")

window.onload = () => {
    body_.classList.add("active")
}

document.addEventListener('DOMContentLoaded', () => {
    const tagInput = document.getElementById('tag-input');
    const tagsList = document.getElementById('tags_list');
    var _experience = document.querySelector("._experience")

    tagInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent the default action of the enter key

            const tagText = tagInput.value.trim();
            _experience.value +=  `${tagText} @/ `
            if (tagText !== '') {
                const tag = document.createElement('p');
                tag.classList.add('tag');
                tag.classList.add('mb-0');
                tag.textContent = tagText;

                tagsList.appendChild(tag);
                tagInput.value = '';
            }
        }
    });

    // var tags_ = document.querySelectorAll(".tag")
    // tags_.forEach((element, index) => {
    //     element.addEventListener("click", () => {
    //         element.classList.add("d-none")
    //     })
    // })    

});
