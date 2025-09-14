// Category Dropdown
const categoryBtn = document.querySelector(".category-btn");
const categoryDropdown = document.querySelector(".category-dropdown");

categoryBtn.addEventListener("click", function(e){
    e.preventDefault();
    categoryDropdown.style.display = categoryDropdown.style.display === "block" ? "none" : "block";
});

window.addEventListener("click", function(e){
    if(!categoryDropdown.contains(e.target) && e.target !== categoryBtn){
        categoryDropdown.style.display = "none";
    }
});

// Modal Functions
function openModal(id){
    document.getElementById('modal-'+id).style.display='flex';
}

function closeModal(id){
    document.getElementById('modal-'+id).style.display='none';
}

// Close modal on click outside
window.addEventListener("click", function(e){
    if(e.target.classList.contains('modal')){
        e.target.style.display = 'none';
    }
});
