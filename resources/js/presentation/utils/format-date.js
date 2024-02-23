export const formatDate = (dateString) => {
    const date = new Date(`${dateString}T00:00:00`);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    return `${day.toString().padStart(2, "0")}/${month
        .toString()
        .padStart(2, "0")}`;
};
