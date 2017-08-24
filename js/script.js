jQuery(document).ready(function($) {
    $('#form1').jqTransform({imgPath:'jqtransformplugin/img/'});
});

document.getElementById('reset').onclick = function() {
    mysel = document.getElementById('myselect');
    mysel.selectedIndex = 0;
    alert(mysel.value);
    return false;
}
