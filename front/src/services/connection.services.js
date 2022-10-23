let saveToken = (token) => {
    localStorage.setItem( 'AuthToken', token );
}

let getToken = () => {
    let token = localStorage.getItem('AuthToken');

    return !!token; // returns any variable as a boolens, instead os null or strings, numbers...
}

export const connectionService = {
    saveToken, getToken
}