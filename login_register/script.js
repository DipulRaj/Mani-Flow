function showForm(formId){
    document.querySelectorAll(".form-Box").forEach(form=>form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}