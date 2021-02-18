let x, y, r;

function isNum(n) {
    return (!isNaN(parseFloat(n)) && isFinite(n))
}


function validateX() {
    x = document.getElementById('X-input').value.replace(",", ".");
    if (x === undefined) {
        document.getElementById('x-comment').innerHTML = "X не введён";
        return false;
    } else if (!isNum(x)) {
        document.getElementById('x-comment').innerHTML ="X не число";
        return false;
    } else if (!((x >= -5) && (x <= 3))) {
        document.getElementById('x-comment').innerHTML = "X не входит в область допустимых значений";
        return false;
    } else {
        document.getElementById('x-comment').innerHTML = " ";
        return true;
    }

}
function validateY() {
    y = document.getElementById('Y-input').value.replace(",", ".");
    if (y === undefined) {
        document.getElementById('y-comment').innerHTML = "Y не введён";
        return false;
    } else if (!isNum(y)) {
        document.getElementById('y-comment').innerHTML = "Y не число";
        return false;
    } else if (!((y >= -3) && (y <= 3))) {
        document.getElementById('y-comment').innerHTML = "Y не входит в область допустимых значений";
        return false;
    } else {
        document.getElementById('y-comment').innerHTML = " ";
        return true;
    }
}

function validateR() {
    r = document.getElementById('R-input').value.replace(",", ".");
    if (r === undefined) {
        document.getElementById('r-comment').innerHTML ="R не введён";
        return false;
    } else if (!isNum(r)) {
        document.getElementById('r-comment').innerHTML ="R не число";
        return false;
    } else if (!((r >= 1) && (r <= 5))) {
        document.getElementById('r-comment').innerHTML = "R не входит в область допустимых значений";
        return false;
    } else {
        document.getElementById('r-comment').innerHTML = " ";
        return true;
    }
}



function check() {
    if (validateX() && validateY() && validateR()){
        document.getElementById('button').disabled = false;
        document.getElementById('incorrectValuesError').innerHTML = ' ';
        } else {
        document.getElementById('button').disabled = true;
        document.getElementById('incorrectValuesError').innerHTML = 'Проверьте введенные значения';
    }
}