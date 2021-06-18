function renderServerErrors(error_bag, error, scope = null) {
    error_bag.clear()
    let server_errors = error.response.data.errors;
    for (let error_key in server_errors) {
        error_bag.add({
            field: error_key,
            msg: server_errors[error_key][0],
            scope: scope
        });
    }
}

export { renderServerErrors }