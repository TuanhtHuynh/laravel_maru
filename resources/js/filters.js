import Vue from 'vue';
export function truncateText(value, limit = 25) {
    if (!value) {
        return "";
    }
    const pattern = /(\d)(?=(\d{3})+(?!\d))/g;
    const truncate = value.substring(0, limit - 3) + "...";
    return value.length > limit ? truncate : value;
}
export function formatVnd(value) {
    if (!value) {
        return "";
    }
    const pattern = /(\d)(?=(\d{3})+(?!\d))/g;
    return String(value).replace(pattern, "$1,");
}