
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.querySelector( "#yoast_masonry" );
    const msnry = new Masonry( grid, {
        itemSelector: ".wpseo_test_block",
        columnWidth: ".wpseo_test_block",
        percentPosition: true,
        gutter: 10
    });

    const button = document.getElementById('wpseo_wo_btn');
    const wrapper = document.getElementById('wpseo_wo');
    button.addEventListener("dblclick", function() {
        msnry.layout();
        msnry.reloadItems()
        wrapper.classList.toggle("active")
        msnry.layout();
    })
})