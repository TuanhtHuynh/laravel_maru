export const joinQueryString = (query) => {
    return Object.keys(query)
        .map((k) => `${k}=${query[k]}`)
        .join("&")
        .trim();
}