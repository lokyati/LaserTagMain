<template>
	<div class='calendar'>
    <div class='header'>
      <a class='arrow' @click='movePreviousYear'>&laquo;</a>
      <a class='arrow' @click='movePreviousMonth'>&lsaquo;</a>
      <span class='title' @click='moveThisMonth'>
        {{ header.label }}
      </span>
      <a class='arrow' @click='moveNextMonth'>&rsaquo;</a>
      <a class='arrow' @click='moveNextYear'>&raquo;</a>
    </div>
    <div class='weekdays'>
      <div class="weekday" v-for='weekday in weekdays'>
        {{ weekday.label_3 }}
      </div>
    </div>
    <div class='week' v-for='week in weeks'>
      <div
        class='day'
        :class='{ today: day.isToday, "not-in-month": !day.inMonth, "selected": day.isSelected }'
        v-for='day in week'
        @click='$emit("selectDay", day)'>
        {{ day[dayKey] }}
      </div>
    </div>
    <h4>Value</h4>
    <div>
      <p>{{ selectDay.day }}</p>
    </div v-else>
  </div>
</template>

<script>
	// Calendar data
const _daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
const _weekdayLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const _weekdayLength = 3;
const _weekdayCasing = 'title';
const _monthLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const _monthLength = 0;
const _monthCasing = 'title';
const _today = new Date();
const _todayComps = {
  year: _today.getFullYear(),
  month: _today.getMonth() + 1,
  day: _today.getDate(),
};

// Helper function for label transformation
const _transformLabel = (label, length, casing) => {
  label = length <= 0 ? label : label.substring(0, length);
  if (casing.toLowerCase() === 'lower') return label.toLowerCase();
  if (casing.toLowerCase() === 'upper') return label.toUpperCase();
  return label;
};

export default ({
  data() {
  	return{
	    month: _todayComps.month,
	    year: _todayComps.year,
	 };
  },
  created() {
    this.$on('configureDay', this.configureDay);
    this.$on('selectDay', this.selectDay);
  },
  props: {
    dayKey: { type: String, default: 'label' },
    value: Date,
  },
  computed: {
	  // Our component exposes month as 1-based, but sometimes we need 0-based
	  monthIndex() {
	    return this.month - 1;
	  },
	  // State referenced by header (no dependencies yet...)
	  months() {
      return _monthLabels.map((ml, i) => ({
        label: ml,
        label_1: ml.substring(0, 1),
        label_2: ml.substring(0, 2),
        label_3: ml.substring(0, 3),
        number: i + 1,
      }));
    },
	  // State for weekday header (no dependencies yet...)
	  weekdays() {
      return _weekdayLabels.map((wl, i) => ({
        label: wl,
        label_1: wl.substring(0, 1),
        label_2: wl.substring(0, 2),
        label_3: wl.substring(0, 3),
        number: i + 1,
      }));
    },
	  // State for calendar header
	  header() {
      const month = this.months[this.monthIndex];
      return {
        month: month,
        year: this.year.toString(),
        shortYear: this.year.toString().substring(2, 4),
        label: month.label + ' ' + this.year,
      };
    },
	  // Returns number for first weekday (1-7), starting from Sunday
	  firstWeekdayInMonth() {
      return new Date(this.year, this.monthIndex, 1).getDay() + 1;
    },
	  // Returns number of days in the current month
	  daysInMonth() {
      // Check for February in a leap year
      if (this.month === 2 && this.isLeapYear) return 29;
      // ...Just a normal month
      return _daysInMonths[this.monthIndex];
    },
	  weeks() {
      const weeks = [];
      let previousMonth = true, thisMonth = false, nextMonth = false;
      let day = this.previousMonthComps.days - this.firstWeekdayInMonth + 2;
      let month = this.previousMonthComps.month;
      let year = this.previousMonthComps.year;
      // Cycle through each week of the month, up to 6 total
      for (let w = 1; w <= 6 && !nextMonth; w++) {
        // Cycle through each weekday
        const week = [];
        for (let d = 1; d <= 7; d++) {
            
          // We need to know when to start counting actual month days
          if (previousMonth && d >= this.firstWeekdayInMonth) {
            // Reset day/month/year counters
            day = 1;
            month = this.month;
            year = this.year;
            // ...and flag we're tracking actual month days
            previousMonth = false;
            thisMonth = true;
                    }
          
          // Append day info for the current week
          // Note: this might or might not be an actual month day
          //  We don't know how the UI wants to display various days,
          //  so we'll supply all the data we can
          const dayInfo = {
            label: (day && thisMonth) ? day.toString() : '',
            day,
            weekday: d,
            week: w,
            month,
            year,
            date: new Date(year, month - 1, day),
            beforeMonth: previousMonth,
            afterMonth: nextMonth,
            inMonth: thisMonth,
            isToday: day === _todayComps.day && month === _todayComps.month && year === _todayComps.year,
            isFirstDay: thisMonth && day === 1,
            isLastDay: thisMonth && day === this.daysInMonth,
          };
          this.$emit('configureDay', dayInfo);
          week.push(dayInfo);
          
          // We've hit the last day of the month
          if (thisMonth && day >= this.daysInMonth) {
            thisMonth = false;
            nextMonth = true;
            day = 1;
            month = this.nextMonthComps.month;
            year = this.nextMonthComps.year;
          // Still in the middle of the month (hasn't ended yet)
          } else {
            day++;
          }
        }
        // Append week info for the month
        weeks.push(week);
      }
      return weeks;
    },
    hasValue() {
      return this.value && typeof this.value.getTime === 'function';
    },
    valueTime() {
        return this.hasValue ? this.value.getTime() : null;
    },
    isLeapYear() {
            return (this.year % 4 === 0 && this.year % 100 !== 0) || this.year % 400 === 0;
    },
    previousMonthComps() {
        if (this.month === 1) return {
        days: _daysInMonths[11],
        month: 12,
        year: this.year - 1,
      }
      return {
        days: (this.month === 3 && this.isLeapYear) ? 29 : _daysInMonths[this.month - 2],
        month: this.month - 1,
        year: this.year,
      };
    },
    nextMonthComps() {
        if (this.month === 12) return {
        days: _daysInMonths[0],
        month: 1,
        year: this.year + 1,
      };
      return {
        days: (this.month === 2 && this.isLeapYear) ? 29 : _daysInMonths[this.month],
        month: this.month + 1,
        year: this.year,
      };
    },
    dateSelectionLabel() {
      return JSON.stringify(this.dateSelection, null, '\t');
    }
	  // End of computed properties
},

methods: {
  moveThisMonth() {
    this.month = _todayComps.month;
    this.year = _todayComps.year;
  },
  moveNextMonth() {
    if (this.month < 12) {
      this.month++;
    } else {
      this.month = 1;
      this.year++;
    }
  },
  movePreviousMonth() {
    if (this.month > 1) {
      this.month--;
    } else {
      this.month = 12;
      this.year--;
    }
  },
  moveNextYear() {
    this.year++;
  },
  movePreviousYear() {
    this.year--;
  },
  configureDay(day) {
      day.isSelected = day.date.getTime() === this.valueTime;
  },
  selectDay(day) {
      this.$emit('input', day.isSelected ? null : day.date);
  }
},
});
</script>

<style>
*{
  box-sizing: border-box
}

#app{
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
  padding: 20px;
}
.calendar{
  display: flex;
  flex-direction: column;
}
.header{
  display: flex;
  justify-content: stretch;
  align-items: center;
  color: white;
  padding: 0.5rem 1rem;
  border: 1px solid #aaaaaa;
  background-color: #ff7a58;
 }
  .arrow{
    padding: 0 0.4em 0.2em 0.4em;
    font-size: 1.8rem;
    font-weight: 500;
    user-select: none;
    flex-grow: 0;
    }
	.arrow:hover{
		color: #dcdcdc;
	}

  .title{
    flex-grow: 1;
    font-size: 1.2rem;
    text-align: center;
}
    .title:hover{
    	color: #dcdcdc;
    }

.weekdays{
  display: flex;
  flex: auto;
 } 
.weekday{
  width: 14.2857%;
  display: flex;
  justify-content: center;
  align-items: center;  
  padding: 0.4rem 0;
  color: #7a7a7a;
  border: 1px solid #aaaaaa;
  background-color: #eaeaea;
  }
.week{
  display: flex;
}
  
.day{
  width: 14.2857%;
  height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #3a3a3a;
  background-color: white;
  border: solid 1px #aaaaaa;
}
.day:hover{
  background-color: #5e7fa0;
}
.today{
  font-weight: 500;
  color: white;
  background-color: #ff7a58;
}
.not-in-month{
  color: #cacaca;
  background-color: #fafafa;
}
.selected{
  color: #fafafa;
  background-color: #5e7fa0;
}
</style>