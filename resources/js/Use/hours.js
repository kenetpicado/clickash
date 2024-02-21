export function getBgColor(hour) {
    if (hour.includes("11:")) return "bg-cyan-600";
    if (hour.includes("9:")) return "bg-indigo-600";
    if (hour.includes("6:")) return "bg-emerald-600";
    if (hour.includes("3:")) return "bg-amber-600";
    //if (hour.includes("8:")) return "bg-red-600";

    return "bg-rose-600";
}

export function getHourClass(hour) {
    const bgColor = getBgColor(hour);

    return `text-sm text-white text-center rounded-xl py-1 ${bgColor}`
}