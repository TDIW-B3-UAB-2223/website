function isMail(email) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email.match(mailformat)) {
        return {state: true};
    }
    else {
        return {
            state: false,
            message: "El correu electrònic no és vàlid!"
        };
    }
}

function isEmpty(field, fieldName) {
    var field = field.trim();
    if (field == "") {
        return {
            state: false,
            message: fieldName + " és buit!"
        }
    }
    return {state: true};
}

function isValidPostalCode(postalCode) {
    var postalCodeFormat = /\d{5}$/;
    if (postalCode.match(postalCodeFormat)) {
        return {state: true};
    }
    return {
        state: false,
        message: "El codi postal no és vàlid!"
    };
}

function validate_user(username, password, email, address, city, postalCode) {
    var errors = [];
    for (let element of [username, password, email, address, city, postalCode]) {
        console.log(element);
        let empty = isEmpty(element, element.name);
        if (!empty.state) {
            errors.push(empty.message);
        }
    }
    if (isMail(email).state == false) {
        errors.push(isMail(email).message);
    }

    if (isValidPostalCode(postalCode).state == false) {
        errors.push(isValidPostalCode(postalCode).message);
    }

    if (errors.length > 0) {
        return {
            state: false,
            error: errors.join("\n")
        }
    } else {
        return {state: true};
    }
}

$("#register_form").submit(function (event) {
    event.preventDefault();
    var fData = new FormData(document.querySelector("#register_form"));
    var data = {};
    fData.forEach((value, key) => data[key] = value);
    let response = validate_user(data.name, data.password, data.email, data.address, data.city, data.postalCode);
    if (response.state) {
        $("#register_form").unbind('submit').submit();
    } else {
        alert(response.error);
    }
});