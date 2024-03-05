export const extractFileName = (url) => {
    return url ? url.substring(url.lastIndexOf("/") + 1) : null;
};