function createCategoryPackageForm_show() {
    document.getElementById('categoryPackageForm').style.display = "block";
}

function createPackageForm_show(category) {
    document.getElementById('pCategoryId').setAttribute("value",category[0]);
    document.getElementsByClassName('categoryTitleForm')[0].id = category[0];
    var titleForm = document.getElementById(category[0]);
    titleForm.textContent += category[1];

    document.getElementById('packageForm').style.display = "block";
}

function updateCategoryPackageForm_show(category) {
    document.getElementById('categoryDescUpdate').setAttribute("value",category[1])
    document.getElementById('categoryIdUpdate').setAttribute("value",category[0])
    document.getElementById('updateCategoryPackageForm').style.display = "block";
}

function updatePackageForm_show(category,package) {
    document.getElementById('pCategoryIdUpdate').setAttribute("value",category[0])
    document.getElementById('packageId').setAttribute("value",package[0])
    document.getElementById('packageDescUpdate').setAttribute("value",package[1])
    document.getElementById('packagePriceUpdate').setAttribute("value",package[2])
    document.getElementById('packageDurationUpdate').setAttribute("value",package[3])
    document.getElementById('updatePackageForm').style.display = "block";
}

function div_hide(){
    document.getElementById(this).style.display = "none";
}





