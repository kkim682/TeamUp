// Setting for form input validation

$(document).ready(function () {

    $('.ui.form')
        .form({
            fields: {
                loginEmail: {
                    identifier: 'loginEmail',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your email address.'
                        }
                    ],
                },
                loginPassword: {
                    identifier: 'loginPassword',
                    depends: 'loginEmail',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your password.'
                        }
                    ]
                },
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
                    depends: 'firstname',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your last name.'
                        }
                    ]
                },
                email: {
                    identifier: 'email',
                    depends: 'lastname',
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
                    depends: 'email',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter your school code.'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    depends: 'email',
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
                    depends: 'password',
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
                },
                courseName: {
                    identifier: 'courseName',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter course name.'
                        }
                    ]
                },

                courseDescription: {
                    identifier: 'courseDescription',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter course description.'
                        }
                    ]
                },
                courseCode: {
                    identifier: 'courseCode',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Please enter a course code you would like to use for this course.'
                        },
                        {
                            type: 'minLength[6]',
                            prompt: 'Your course code must be at least {ruleValue} characters'
                        }
                    ]       
                },
            }
        });

});
