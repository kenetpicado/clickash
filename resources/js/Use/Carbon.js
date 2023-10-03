const DATE_UNITS = {
    year: 31536000,
    month: 2592000,
    day: 86400,
    hour: 3600,
    minute: 60,
    second: 1,
};

export class Carbon {
    date;

    constructor(dateString) {
        if (dateString && !dateString.includes(":")) {
            dateString = dateString + "T06:00:00.000000Z";
        }

        if (!dateString) {
            this.date = new Date();
        } else {
            this.date = new Date(dateString);
        }
    }

    static create(dateString) {
        return new Carbon(dateString);
    }

    static today(format = "Y-m-d") {
        return new Carbon().format(format);
    }

    static now() {
        return new Carbon();
    }

    monthName() {
        const months = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ];

        return months[this.date.getMonth()];
    }

    month() {
        return this.date.getMonth() + 1;
    }

    addMonth(month = 1) {
        this.date.setMonth(this.date.getMonth() + month);
        return this;
    }

    addDays(days = 1) {
        this.date.setDate(this.date.getDate() + days);
        return this;
    }

    addPeriod(period) {
        if (period == 30) {
            this.addMonth();
        } else {
            this.addDays(period);
        }

        return this;
    }

    setTime(time) {
        const [hours, minutes, seconds] = time.split(":");
        this.date.setHours(hours);
        this.date.setMinutes(minutes);
        this.date.setSeconds(seconds);
        return this;
    }

    getTimeFormat() {
        const hours = this.date.getHours();
        const minutes = this.date.getMinutes();

        const formattedMinutes = minutes.toString().padStart(2, "0");

        if (hours >= 12) {
            if (hours > 12) {
                return `${hours - 12}:${formattedMinutes} PM`;
            } else {
                return `${hours}:${formattedMinutes} PM`;
            }
        }

        return `${hours}:${formattedMinutes} AM`;
    }

    format(format = "Y-m-d") {
        const month = formatValue(this.date.getMonth() + 1);

        return format
            .replace("Y", this.date.getFullYear())
            .replace("m", month)
            .replace("d", formatValue(this.date.getDate()))
            .replace("H", formatValue(this.date.getHours()))
            .replace("i", formatValue(this.date.getMinutes()))
            .replace("s", formatValue(this.date.getSeconds()))
            .replace("F", this.monthName());
    }

    static simpleFormat(dateString, format = "d/m/Y") {
        const [year, month, day] = dateString.split("-");

        return format
            .replace("Y", year)
            .replace("m", month)
            .replace("d", day)
            .toString();
    }

    diffForHumans() {
        const currentTimestamp = Math.floor(Date.now() / 1000);
        const targetTimestamp = Math.floor(this.date.getTime() / 1000);
        const diff = currentTimestamp - targetTimestamp;

        const rtf = new Intl.RelativeTimeFormat(navigator.language, {
            numeric: "auto",
        });

        if (diff > 0) {
            for (const unit in DATE_UNITS) {
                if (diff >= DATE_UNITS[unit]) {
                    const value = Math.floor(diff / DATE_UNITS[unit]);
                    return rtf.format(-value, unit);
                }
            }
        } else {
            for (const unit in DATE_UNITS) {
                if (diff <= -DATE_UNITS[unit]) {
                    const value = Math.floor(diff / DATE_UNITS[unit]);
                    return rtf.format(-value, unit);
                }
            }
        }

        return "Ahora";
    }
}

function formatValue(value) {
    return value.toString().padStart(2, "0");
}
