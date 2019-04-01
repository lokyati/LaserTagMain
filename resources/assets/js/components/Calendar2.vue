<template>
	<div class='calendar'>
    <div class='header'>
      <a class='arrow' @click='movePreviousMonth'>&lsaquo;</a>
      <span class='title' @click='moveThisMonth'>
        {{ header.label }}
      </span>
      <a class='arrow' @click='moveNextMonth'>&rsaquo;</a>
    </div>
    <div class='weekdays'>
      <div class="weekday" v-for='weekday in weekdays'>
        {{ weekday.label }}
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
    <div class="info" v-bind:class="{show:show}">
      <p>Szabad időpontok ezen a napon: {{ header.label }}  {{picked.day}}. {{message}}</p>
    </div>
    <div class="columns is-marginless" v-bind:class="{show:show}">
        <div class="column is-1 eight" v-bind:class="{eightStyle:eightStyle, desired8:desired8}" @click='isSelected8'>
            <a>08:00</a>
        </div>
        <div class="column is-1 nine" v-bind:class="{nineStyle:nineStyle, desired9:desired9}" @click='isSelected9'>
            <a>09:00</a>
        </div>
        <div class="column is-1 ten" v-bind:class="{tenStyle:tenStyle, desired10:desired10}" @click='isSelected10'>
            <a>10:00</a>
        </div>
        <div class="column is-1 eleven" v-bind:class="{elevenStyle:elevenStyle, desired11:desired11}" @click='isSelected11'>
            <a>11:00</a>
        </div>
        <div class="column is-1 twelve" v-bind:class="{twelveStyle:twelveStyle, desired12:desired12}" @click='isSelected12'>
            <a>12:00</a>
        </div>
        <div class="column is-1 thrtn" v-bind:class="{thrtnStyle:thrtnStyle, desired13:desired13}" @click='isSelected13'>
            <a>13:00</a>
        </div>
        <div class="column is-1 frtn" v-bind:class="{frtnStyle:frtnStyle, desired14:desired14}" @click='isSelected14'>
            <a>14:00</a>
        </div>
        <div class="column is-1 fiftn" v-bind:class="{fiftnStyle:fiftnStyle, desired15:desired15}" @click='isSelected15'>
            <a>15:00</a>
        </div>
        <div class="column is-1 sixtn" v-bind:class="{sixtnStyle:sixtnStyle, desired16:desired16}" @click='isSelected16'>
            <a>16:00</a>
        </div>
        <div class="column is-1 svntn" v-bind:class="{svntnStyle:svntnStyle, desired17:desired17}" @click='isSelected17'>
            <a>17:00</a>
        </div>
        <div class="column is-1 eightn" v-bind:class="{eightnStyle:eightnStyle, desired18:desired18}" @click='isSelected18'>
            <a>18:00</a>
        </div>
        <div class="column is-1 ninetn" v-bind:class="{ninetnStyle:ninetnStyle, desired19:desired19}" @click='isSelected19'>
            <a>19:00</a>
        </div>
        <div class="column is-1 twenty" v-bind:class="{twentyStyle:twentyStyle, desired20:desired20}" @click='isSelected20'>
            <a>20:00</a>
        </div>
    </div>
    <div class="button_container" v-bind:class="{show:show}">  
      <a class="button is-warning is-medium" @click="sendReservation">Foglalok</a>
    </div>
    <div v-for="hour in hours">
      <p>Foglalt orak: {{hour}}</p>
    </div>
  </div>
</template>

<script>
	// Calendar data
const _daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
const _weekdayLabels = ['Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'];
const _weekdayLength = 3;
const _weekdayCasing = 'title';
const _monthLabels = ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Octóber', 'November', 'December'];
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
      picked: _todayComps,
      selectedday: _todayComps.day,
      selectedmonth: _todayComps.month,
      hour: '',
      reservationID: '',
      hours: [],
      reservedhours: [],
      desiredHours: [],
      reservations: {},
      bookedMonth: {},
      bookedDay: {},
      eightStyle: false,
      nineStyle: false,
      tenStyle: false,
      elevenStyle: false,
      twelveStyle: false,
      thrtnStyle: false,
      frtnStyle: false,
      fiftnStyle: false,
      sixtnStyle: false,
      svntnStyle: false,
      eightnStyle: false,
      ninetnStyle: false,
      twentyStyle: false,
      message: 'Csak egymást követő órák foglalhatók!',
      show: false,
      desired8: false,
      desired9: false,
      desired10: false,
      desired11: false,
      desired12: false,
      desired13: false,
      desired14: false,
      desired15: false,
      desired16: false,
      desired17: false,
      desired18: false,
      desired19: false,
      desired20: false,
      a: 0,
	 };
  },
  created() {
    this.$on('configureDay', this.configureDay);
    this.$on('selectDay', this.selectDay);
    this.getReservations();
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
        label: this.year + ' ' + month.label,
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
    },
    
	  // End of computed properties
},
mounted() {
  this.getReservations();
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
  configureDay(day) {
      day.isSelected = day.date.getTime() === this.valueTime;
  },
  selectDay(day) {
      
      this.reservationID = '';
      this.reservedhours = [];

      this.$emit('input', day.isSelected ? null : day.date);
      this.picked = day;
      this.selectedday = this.picked.day;
      this.selectedmonth = this.picked.month;
      //console.log(day);
      //console.log(this.picked);
      //console.log(this.selectedmonth);
      //console.log(this.selectedday);

      this.show = true;
      console.log("Veget ert a SelectDay, indul a getReservations");
      this.getReservations();
  },
  //Show Reservation methods
  getReservations() {
    console.log("getReservations fut")
    this.hours = []; //kiuriti a tombot
    axios.get('./api/reservations').then(response => {
      this.reservations = response.data;
      console.log(this.reservations);
    });
   
    this.message = "Csak egymást követő órák foglalhatók!";

    for (var i = 0; i < this.reservations.length; i++) {
        if(this.reservations[i].month == this.selectedmonth && this.reservations[i].day == this.selectedday){
          this.reservationID = this.reservations[i].id
        }
    }
    console.log("getReservations veget er, indul a getReservedHours");
    this.getReservedHours();
  },
  getReservedHours(){
    this.allFalse();
    console.log("A getReservedHours ban vagyunk");
    axios.get('./api/Reservedhours').then(response => {
      this.reservedhours = response.data
      //console.log(this.reservedhours)
    
      for (var i = 0; i < this.reservedhours.length; i++) {
        if(this.reservedhours[i].reservation_id == this.reservationID){
          //this.hours.push(this.reservedhours[i].hour );
          if(this.reservedhours[i].hour == 8){
            this.eightStyle = true;
          }
          else if(this.reservedhours[i].hour == 9){
            this.nineStyle = true;
          }
          else if(this.reservedhours[i].hour == 10){
            this.tenStyle = true;
          }
          else if(this.reservedhours[i].hour == 11){
            this.elevenStyle = true;
          }
          else if(this.reservedhours[i].hour == 12){
            this.twelveStyle = true;
          }
          else if(this.reservedhours[i].hour == 13){
            this.thrtnStyle = true;
          }
          else if(this.reservedhours[i].hour == 14){
            this.frtnStyle = true;
          }
          else if(this.reservedhours[i].hour == 15){
            this.fiftnStyle = true;
          }
          else if(this.reservedhours[i].hour == 16){
            this.sixtnStyle = true;
          }
          else if(this.reservedhours[i].hour == 17){
            this.svntnStyle = true;
          }
          else if(this.reservedhours[i].hour == 18){
            this.eightnStyle = true;
          }
          else if(this.reservedhours[i].hour == 19){
            this.ninetnStyle = true;
          }
          else if(this.reservedhours[i].hour == 20){
            this.twentyStyle = true;
          }
        }
      }

      console.log(this.hours);
      console.log(this.hours.length);
      //console.log(this.hours)
    });
    //this.allFalse();

    for (var i = 0; i < this.hours.length; i++) {
      if(this.hours[i] == 8){
        this.eightStyle = true;
      }
      else if(this.hours[i] == 9){
        this.nineStyle = true;
      }
      else if(this.hours[i] == 10){
        this.tenStyle = true;
      }
      else if(this.hours[i] == 11){
        this.elevenStyle = true;
      }
      else if(this.hours[i] == 12){
        this.twelveStyle = true;
      }
      else if(this.hours[i] == 13){
        this.thrtnStyle = true;
      }
      else if(this.hours[i] == 14){
        this.frtnStyle = true;
      }
      else if(this.hours[i] == 15){
        this.fiftnStyle = true;
      }
      else if(this.hours[i] == 16){
        this.sixtnStyle = true;
      }
      else if(this.hours[i] == 17){
        this.svntnStyle = true;
      }
      else if(this.hours[i] == 18){
        this.eightnStyle = true;
      }
      else if(this.hours[i] == 19){
        this.ninetnStyle = true;
      }
      else if(this.hours[i] == 20){
        this.twentyStyle = true;
      }
    }
    if(this.eightStyle  == true &&
       this.nineStyle   == true &&
       this.tenStyle    == true &&
       this.elevenStyle == true &&
       this.twelveStyle == true &&
       this.thrtnStyle  == true &&
       this.frtnStyle   == true &&
       this.fiftnStyle  == true &&
       this.sixtnStyle  == true &&
       this.svntnStyle  == true &&
       this.eightnStyle == true &&
       this.ninetnStyle == true &&
       this.twentyStyle == true){
      this.message = "Sajnos ma minden időpont foglalt! Válassz egy másik napot. :)";
    }
  },
  allFalse(){
    console.log("minden ures");

    this.eightStyle  = false;
    this.nineStyle   = false;
    this.tenStyle    = false;
    this.elevenStyle = false;
    this.twelveStyle = false;
    this.thrtnStyle  = false;
    this.frtnStyle   = false;
    this.fiftnStyle  = false;
    this.sixtnStyle  = false;
    this.svntnStyle  = false;
    this.eightnStyle = false;
    this.ninetnStyle = false;
    this.twentyStyle = false;
    this.desired8    = false;
    this.desired9    = false;
    this.desired10   = false;
    this.desired11   = false;
    this.desired12   = false;
    this.desired13   = false;
    this.desired14   = false;
    this.desired15   = false;
    this.desired16   = false;
    this.desired17   = false;
    this.desired18   = false;
    this.desired19   = false;
    this.desired20   = false;
  },
  //Reserving methods
  isSelected8(){
    if(this.eightStyle == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired9 == true){
      this.desired8 = !this.desired8;

      if(this.desired8 == true){
        this.desiredHours.push(8);
      }
      else if( this.desired8 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 8){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected9(){
    if(this.nineStyle == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired10 == true){
      this.desired9 = !this.desired9;

      if(this.desired9 == true){
        this.desiredHours.push(9);
      }
      else if( this.desired9 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 9){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected10(){
    if(this.tenStyle == false && this.desired8 == false &&this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired9 == true || this.desired11 == true){
      this.desired10 = !this.desired10;

      if(this.desired10 == true){
        this.desiredHours.push(10);
      }
      else if( this.desired10 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 10){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected11(){
    if(this.elevenStyle == false && this.desired8 == false && this.desired9 == false &&this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired10 == true || this.desired12 == true){
      this.desired11 = !this.desired11;

      if(this.desired11 == true){
        this.desiredHours.push(11);
      }
      else if( this.desired11 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 11){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected12(){
    if(this.twelveStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false &&  this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired11 == true || this.desired13 == true){
      this.desired12 = !this.desired12;

      if(this.desired12 == true){
        this.desiredHours.push(12);
      }
      else if( this.desired12 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 12){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected13(){
    if(this.thrtnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired12 == true || this.desired14 == true){
      this.desired13 = !this.desired13;

      if(this.desired13 == true){
        this.desiredHours.push(13);
      }
      else if( this.desired13 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 13){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected14(){
    if(this.frtnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired13 == true || this.desired15 == true){
      this.desired14 = !this.desired14;

      if(this.desired14 == true){
        this.desiredHours.push(14);
      }
      else if( this.desired14 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 14){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected15(){
    if(this.fiftnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired17 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired14 == true || this.desired16 == true){
      this.desired15 = !this.desired15;

      if(this.desired15 == true){
        this.desiredHours.push(15);
      }
      else if( this.desired15 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 15){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected16(){
    if(this.sixtnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired18 == false && this.desired19 == false && this.desired20 == false || this.desired15 == true || this.desired17 == true){
      this.desired16 = !this.desired16;

      if(this.desired16 == true){
        this.desiredHours.push(16);
      }
      else if( this.desired16 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 16){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected17(){
    if(this.svntnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired19 == false && this.desired20 == false || this.desired16 == true || this.desired18 == true){
      this.desired17 = !this.desired17;

      if(this.desired17 == true){
        this.desiredHours.push(17);
      }
      else if( this.desired17 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 17){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected18(){
    if(this.eightStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired20 == false || this.desired17 == true || this.desired19 == true){
      this.desired18 = !this.desired18;

      if(this.desired18 == true){
        this.desiredHours.push(18);
      }
      else if( this.desired18 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 18){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected19(){
    if(this.ninetnStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false || this.desired18 == true || this.desired20 == true){
      this.desired19 = !this.desired19;

      if(this.desired19 == true){
        this.desiredHours.push(19);
      }
      else if( this.desired19 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 19){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  isSelected20(){
    if(this.twentyStyle == false && this.desired8 == false && this.desired9 == false && this.desired10 == false && this.desired11 == false && this.desired12 == false && this.desired13 == false && this.desired14 == false && this.desired15 == false && this.desired16 == false && this.desired17 == false && this.desired18 == false || this.desired19 == true){
      this.desired20 = !this.desired20;

      if(this.desired20 == true){
        this.desiredHours.push(20);
      }
      else if( this.desired20 == false){
        for (var i = 0; i < this.desiredHours.length; i++) {
          if(this.desiredHours[i] == 20){
            this.$delete(this.desiredHours, i);
          }
        }
      }
    }
  },
  sendReservation(){
      axios.post('./api/createReservation',{
        hour: this.desiredHours,
        year: this.picked.year,
        month: this.picked.month,
        day: this.picked.day,
      });
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
  background-color: orange;
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
  background-color: #5f5f5f;
  color:white;
}
.today{
  font-weight: 500;
  color: white;
  background-color: orange;
}
.not-in-month{
  color: #cacaca !important; 
  background-color: #fafafa !important;
}
.selected{
  color: #fafafa;
  background-color: #333;
}

.columns{
  width: 59em;
  border: 3px solid orange;
  display: none !important;
}
.show.columns{
  display: flex !important;
}
.column{
  padding: 0.75rem 0;
  background-color: #333;
}
.column:hover{
  background-color: #575656;
}
.column a{
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
.column.is-1{
  width: 7.712%;
  border-right: 2px solid orange;
}
.info{
  display: none;
}
.show.info{
  display: block;
}
.button_container{
  width:200px;
  padding: 1rem;
  display: none;
}
.show.button_container{
  display: block;
}
/*Occupied style*/
.eightStyle.eight{
  background-color: red;
  pointer-events: none;
}
.desired8.eight{
  background-color: green;
}
.nineStyle.nine{
  background-color: red;
  pointer-events: none;
}
.desired9.nine{
  background-color: green;
}
.tenStyle.ten{
  background-color: red;
  pointer-events: none;
}
.desired10.ten{
  background-color: green;
}
.elevenStyle.eleven{
  background-color: red;
  pointer-events: none;
}
.desired11.eleven{
  background-color: green;
}
.twelveStyle.twelve{
  background-color: red;
  pointer-events: none;
}
.desired12.twelve{
  background-color: green;
}
.thrtnStyle.thrtn{
  background-color: red;
  pointer-events: none;
}
.desired13.thrtn{
  background-color: green;
}
.frtnStyle.frtn{
  background-color: red;
  pointer-events: none;
}
.desired14.frtn{
  background-color: green;
}
.fiftnStyle.fiftn{
  background-color: red;
  pointer-events: none;
}
.desired15.fiftn{
  background-color: green;
}
.sixtnStyle.sixtn{
  background-color: red;
  pointer-events: none;
}
.desired16.sixtn{
  background-color: green;
}
.svntnStyle.svntn{
  background-color: red;
  pointer-events: none;
}
.desired17.svntn{
  background-color: green;
}
.eightnStyle.eightn{
  background-color: red;
  pointer-events: none;
}
.desired18.eightn{
  background-color: green;
}
.ninetnStyle.ninetn{
  background-color: red;
  pointer-events: none;
}
.desired19.ninetn{
  background-color: green;
}
.twentyStyle.twenty{
  background-color: red;
  pointer-events: none;
}
.desired20.twenty{
  background-color: green;
}
</style>