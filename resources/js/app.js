import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

const deleteSubButton = document.querySelectorAll(".delete-button");

deleteSubButton.forEach((button)=> {
    button.addEventListener("click", (event) =>{
        event.preventDefault();

        const itemTitle = button.getAttribute("data-item-title");

        const modal = document.getElementById("deleteModal");
        console.log(itemTitle);

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        console.log("click1");
        const deleteModalItemTitle = modal.querySelector("#deleteModalItemTitle");
        deleteModalItemTitle.textContent = itemTitle;
        console.log("click2");

        const deleteModalButton = document.querySelector(".delete-modal-button");
        deleteModalButton.addEventListener("click", () => {
            button.parentElement.submit()
        });
    })
})
