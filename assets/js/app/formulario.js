(function() {    
    
    function validarInputs () {        
        $.each($("form input"), function (index, input) {
            if (input.type == "text" || input.type == "email" || input.type == "password")
                if (input.value.length == 0)
                    $(input).addClass("error")
                else
                    $(input).removeClass("error")
        })        
    }    

    function validarRadios () {
        let radios = $("input:radio"), res = false           
        if (radios.length > 0)
            for (let radio of radios)
                if (res |= radio.checked)
                    break
        if (res)
            $(radios).parent().removeClass("error")
        else
            $(radios).parent().addClass("error")
        return res
    }

    function validarCheckboxes () {
        let checkboxes = $("input:checkbox"), res = false
        if (checkboxes.length > 0)
            for (let checkbox of checkboxes)
                if (res &= checkbox.checked)
                    break
        if (res)
            $(checkboxes).parent().removeClass("error")
        else
            $(checkboxes).parent().addClass("error")
        return res;
    }   

    $("form").on("submit", function (e) {
        console.log("sumbit")
        console.log(!validarCheckboxes())
        console.log(!validarRadios())
        console.log(!validarInputs())
        if (!validarInputs() || !validarRadios() || !validarCheckboxes()) {            
            e.preventDefault()
        }
    })

    function focusInput () {        
        $(this).parent().children(":eq(0)").removeClass("error")
        $(this).parent().children(":eq(1)").addClass("active")     
    };

    function blurInput () {
        if (this.value <= 0) {            
            $(this).parent().children(":eq(0)").addClass("error")
            $(this).parent().children(":eq(1)").removeClass("active")            
        }
        else {
            $(this).parent().children(":eq(0)").removeClass("error")
            $(this).parent().children(":eq(1)").addClass("active")
        }
    };
    
    $.each($("form input"), function (index, input) {
        switch ($(input).prop("type")) {
            case "text":
            case "email":
            case "password":
            case "number":
                $(input).focus(focusInput)
                $(input).blur(blurInput)
                break
        }
    })  
}())