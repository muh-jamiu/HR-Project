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

    const tagSkill = document.getElementById('tag-skills');
    const tags_skill_list = document.getElementById('tags_skill_list');
    var _skills_ = document.querySelector("._skills_")

    tagSkill.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent the default action of the enter key

            const tagText = tagSkill.value.trim();
            _skills_.value +=  `${tagText} @/ `
            if (tagText !== '') {
                const tag = document.createElement('p');
                tag.classList.add('tag');
                tag.classList.add('mb-0');
                tag.textContent = tagText;

                tags_skill_list.appendChild(tag);
                tagSkill.value = '';
            }
        }
    });

    document.getElementById('numberInput').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, ''); // Remove non-numeric characters
        value = Number(value).toLocaleString(); // Format number with commas
        e.target.value = "$ " + value;
    }); 

    document.getElementById('form_s').addEventListener("submit", e => {
        var val = tags_skill_list.innerHTML
        var val1 = tagsList.innerHTML
        if(val == ""){
            Swal.fire({
                icon: "error",
                title: "Missing Field",
                text: "Skills Field is required for job posting",
            });
            return e.preventDefault()
        }

        if(val1 == ""){
            Swal.fire({
                icon: "error",
                title: "Missing Field",
                text: "Experience Field is required for job posting",
            });
            
            return e.preventDefault()
        }
    })

});

var avatar__ = document.getElementById("avatar__")
var upload_form = document.getElementById("upload_form")
avatar__.addEventListener("change", () => {
    upload_form.submit();
})

function showAlert(title, icon, text){
    Swal.fire({
        icon: icon,
        title: title,
        text: ttext,
        footer: '<a href="#">Why do I have this issue?</a>'
    });
}

flatpickr("#checkdate", {
    mode: "range",
    position: "top",
    enableTime: false,
    altInput: true,
    altFormat: "D, d M Y",
    dateFormat: "d-m-Y",
    monthSelectorType: "static",
    locale: {
        rangeSeparator: " - ",
    },

    onChange: function (selectedDates, dateStr, instance) {
        ratesParamChange(selectedDates, this);
    },

    onClose: function (selectedDates, dateStr, instance) {
        setCheckoutDate(selectedDates, this);
    },

    onReady: function (selectedDates, dateStr, instance) {       
        instance.setDate(
            [new Date().fp_incr(0), new Date().fp_incr(1)],
            false
        );
    },
});