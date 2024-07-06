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

    document.getElementById('numberInput').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, ''); // Remove non-numeric characters
        value = Number(value).toLocaleString(); // Format number with commas
        e.target.value = "$ " + value;
    }); 

});

var avatar__ = document.getElementById("avatar__")
var upload_form = document.getElementById("upload_form")
avatar__.addEventListener("change", () => {
    upload_form.submit();
})