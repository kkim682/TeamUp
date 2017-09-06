// Setting for form input validation

$(document).ready(function () {
    
    $('.ui.form')
        .form({
            fields: {
                firstname: {
                    identifier: 'firstname',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your first name.'
                        }
                    ]
                },
                lastname: {
                    identifier: 'lastname',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your last name.'
                        }
                    ]
                },
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your email address.'
                        },
                        {
                            type: 'email',
                            prompt: 'Please enter a valid email address.'
                        }

                    ]
                },
                school: {
                    identifier: 'school',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your school code.'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter a password.'
                        },
                        {
                            type: 'minLength[6]',
                            prompt: 'Your password must be at least {ruleValue} characters'
                        }
                    ]
                },
                confirmpassword: {
                    identifier: 'confirmpassword',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please confirm your password.'
                        },
                        {
                            type: 'match[password]',
                            prompt: 'The passwords must match.'
                        }
                    ]
                }
            }
        });

});
