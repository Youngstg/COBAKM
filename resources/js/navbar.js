function Open(target) {
    let e = document.querySelector(target);
    // e.classList.toggle('active')
    if (e.classList.contains("hidden")) {
        e.classList.remove("hidden");
        e.classList.add("block");
    } else {
        e.classList.remove("block");
        e.classList.add("hidden");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Tombol 1
    const dropdownToggle1 =
        document.getElementById("dropdown-toggle1");
    const dropdownMenu1 = document.getElementById("dropdown-menu1");

    dropdownToggle1.addEventListener("click", function () {
        dropdownMenu1.classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        const target = event.target;
        if (
            !dropdownToggle1.contains(target) &&
            !dropdownMenu1.contains(target)
        ) {
            dropdownMenu1.classList.add("hidden");
        }
    });

    // Tombol 2
    const dropdownToggle2 =
        document.getElementById("dropdown-toggle2");
    const dropdownMenu2 = document.getElementById("dropdown-menu2");

    dropdownToggle2.addEventListener("click", function () {
        dropdownMenu2.classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        const target = event.target;
        if (
            !dropdownToggle2.contains(target) &&
            !dropdownMenu2.contains(target)
        ) {
            dropdownMenu2.classList.add("hidden");
        }
    });

    // Tombol 3
    const dropdownToggle3 =
        document.getElementById("dropdown-toggle3");
    const dropdownMenu3 = document.getElementById("dropdown-menu3");

    dropdownToggle3.addEventListener("click", function () {
        dropdownMenu3.classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        const target = event.target;
        if (
            !dropdownToggle3.contains(target) &&
            !dropdownMenu3.contains(target)
        ) {
            dropdownMenu3.classList.add("hidden");
        }
    });
    dropdownMenu1.classList.add("hidden");
    dropdownMenu2.classList.add("hidden");
    dropdownMenu3.classList.add("hidden");
});