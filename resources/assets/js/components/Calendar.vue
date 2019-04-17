<template>
<div class="calendar_container">
  <div id="modals">
    <loading :active.sync="isLoading"
             :is-full-page="fullPage"
             :loader="loader"
             :opacity="opacity"
             :height="height"
             :width="width"
             :transition="transition"></loading>
    <successmodal v-bind:success="showsuccess"
                  v-if="showsuccess" 
                  @close="showsuccess = false"></successmodal>
    <failmodal v-bind:fail="showfail" :message="message"
               v-if="showfail" 
               @close="showfail = false"></failmodal>
  </div>
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
  </div>
  <div class="reservationData_container">
    <div class="info" v-bind:class="{show:show}">
      <p>Szabad időpontok ezen a napon: </p><p class="selectedday">{{ header.label }} {{picked.day}}.</p><p class="messagetext"> {{message}} </p>
    </div>
    <div class="hours_container"v-bind:class="{show:show}">
      <div class="columns is-marginless">
          <div class="column is-1 eight hour_container" v-bind:class="{eightStyle:eightStyle, desired8:desired8}" @click='isSelected8'>
              <a>08:00</a>
          </div>
          <div class="column is-1 nine hour_container" v-bind:class="{nineStyle:nineStyle, desired9:desired9}" @click='isSelected9'>
              <a>09:00</a>
          </div>
          <div class="column is-1 ten hour_container" v-bind:class="{tenStyle:tenStyle, desired10:desired10}" @click='isSelected10'>
              <a>10:00</a>
          </div>
          <div class="column is-1 eleven hour_container" v-bind:class="{elevenStyle:elevenStyle, desired11:desired11}" @click='isSelected11'>
              <a>11:00</a>
          </div>
          <div class="column is-1 twelve hour_container" v-bind:class="{twelveStyle:twelveStyle, desired12:desired12}" @click='isSelected12'>
              <a>12:00</a>
          </div>
          <div class="column is-1 thrtn hour_container" v-bind:class="{thrtnStyle:thrtnStyle, desired13:desired13}" @click='isSelected13'>
              <a>13:00</a>
          </div>
          <div class="column is-1 frtn hour_container" v-bind:class="{frtnStyle:frtnStyle, desired14:desired14}" @click='isSelected14'>
              <a>14:00</a>
          </div>
          <div class="column is-1 fiftn hour_container" v-bind:class="{fiftnStyle:fiftnStyle, desired15:desired15}" @click='isSelected15'>
              <a>15:00</a>
          </div>
          <div class="column is-1 sixtn hour_container" v-bind:class="{sixtnStyle:sixtnStyle, desired16:desired16}" @click='isSelected16'>
              <a>16:00</a>
          </div>
          <div class="column is-1 svntn hour_container" v-bind:class="{svntnStyle:svntnStyle, desired17:desired17}" @click='isSelected17'>
              <a>17:00</a>
          </div>
          <div class="column is-1 eightn hour_container" v-bind:class="{eightnStyle:eightnStyle, desired18:desired18}" @click='isSelected18'>
              <a>18:00</a>
          </div>
          <div class="column is-1 ninetn hour_container" v-bind:class="{ninetnStyle:ninetnStyle, desired19:desired19}" @click='isSelected19'>
              <a>19:00</a>
          </div>
          <div class="column is-1 twenty hour_container" v-bind:class="{twentyStyle:twentyStyle, desired20:desired20}" @click='isSelected20'>
              <a>20:00</a>
          </div>
      </div>
    </div>
    <div class="form">
      <div class="players">
        <p>Jatekosok szama:* </p>
        <div class="control">
          <div class="select is-primary" required>
            <select v-model="selectedPlayers">
              <option v-for="player in players">{{player}}</option>
            </select> 
          </div>
        </div>
      </div>
      <div class="tel">
        <p>Tel.:*</p>
        <input class="input" type="text" placeholder="Tel" v-model="tel" required>
      </div>
      <div class="note">
        <p>Megjegyzes:</p>
        <div class="textarea_container">
          <textarea class="textarea" placeholder="10 lines of textarea" rows="5" v-model="note"></textarea>
        </div>
      </div>
    </div>
    <div class="button_container" v-bind:class="{show:show}">  
      <a class="button is-warning is-medium" @click="sendReservation">Foglalok</a>
    </div>
  </div>
</div>
</template>

<script>
import SuccessModal from './SuccessModal'
import FailModal from './FailModal'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

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
      reservationID: [],
      reservedhours: [],
      desiredHours: [],
      reservations: {},
      unavaible: [],
      players: [6,8,10,12,14,16,18,20],
      selectedPlayers: {},

      show: false,
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
      validated: false,
      showsuccess: false,
      showfail: false,
      isLoading: false,
      fullPage: true,

      message: 'Csak egymást követő órák foglalhatók!',
      tel: '',
      note: '',
      resID: '',
      loader: 'bars',
      opacity: 0.8,
      height: 100,
      width: 100,
      transition: 'none'
	 };
  },
  components: {
    successmodal: SuccessModal,
    failmodal: FailModal,
    loading: Loading,
  },
  created() {
    this.$on('configureDay', this.configureDay);
    this.$on('selectDay', this.selectDay);
    this.getReservations();
  },
  props: {
    dayKey: { type: String, default: 'label' },
    value: Date,
    userID: Number,
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
      this.allFalse();
      this.reservationID = [];
      this.reservedhours = [];
      this.desiredHours = [];

      this.$emit('input', day.isSelected ? null : day.date);
      this.picked = day;
      this.selectedday = this.picked.day;
      this.selectedmonth = this.picked.month;

      this.show = true;
      this.getReservations();
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false
      },1000)
  },
  //Show Reservation methods
  getReservations() {
    axios.get('./api/reservations').then(response => {
      this.reservations = response.data;
      //console.log(this.reservations);
    }).catch(function (error) {
        console.log(error);
      });
   
    this.message = "Csak egymást követő órák foglalhatók!";

    for (var i = 0; i < this.reservations.length; i++) {
        if(this.reservations[i].month == this.selectedmonth && this.reservations[i].day == this.selectedday){
          this.reservationID.push(this.reservations[i].id);
          this.getReservedHours();
        }

    }
    
  },
  getReservedHours(){
    
    axios.get('./api/Reservedhours').then(response => {
      this.reservedhours = response.data
      //console.log(this.reservedhours)
    for (var k = 0; k < this.reservationID.length; k++) {
      this.resID = this.reservationID[k];
      for (var i = 0; i < this.reservedhours.length; i++) {
        if(this.reservedhours[i].reservation_id == this.resID){
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

      console.log(this.hours);
      console.log(this.hours.length);
    }).catch(function (error) {
        console.log(error);
      });
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
    this.reservationID = [];
    this.resID = '';

    if(this.desiredHours.length > 0 && this.selectedPlayers != "" && this.tel != ""){
      axios.get('./api/reservations').then(response => {
        this.reservations = response.data;
        //console.log(this.reservations);
      }).catch(function (error) {
        console.log(error);
      });
      for (var i = 0; i < this.reservations.length; i++) {
        if(this.reservations[i].month == this.selectedmonth && this.reservations[i].day == this.selectedday){
          this.reservationID.push(this.reservations[i].id);
        }
      }
      if(this.reservationID.length > 0){
      axios.get('./api/Reservedhours').then(response => {
        this.reservedhours = response.data

        for (var k = 0; k < this.reservationID.length; k++) {
          this.resID = this.reservationID[k];
          for (var i = 0; i < this.reservedhours.length; i++) {
          if(this.reservedhours[i].reservation_id == this.resID){
            if(this.reservedhours[i].hour == 8){
              this.eightStyle = true;
              this.unavaible.push(8);
            }
            else if(this.reservedhours[i].hour == 9){
              this.nineStyle = true;
              this.unavaible.push(9);
            }
            else if(this.reservedhours[i].hour == 10){
              this.tenStyle = true;
              this.unavaible.push(10);
            }
            else if(this.reservedhours[i].hour == 11){
              this.elevenStyle = true;
              this.unavaible.push(11);
            }
            else if(this.reservedhours[i].hour == 12){
              this.twelveStyle = true;
              this.unavaible.push(12);
            }
            else if(this.reservedhours[i].hour == 13){
              this.thrtnStyle = true;
              this.unavaible.push(13);
            }
            else if(this.reservedhours[i].hour == 14){
              this.frtnStyle = true;
              this.unavaible.push(14);
            }
            else if(this.reservedhours[i].hour == 15){
              this.fiftnStyle = true;
              this.unavaible.push(15);
            }
            else if(this.reservedhours[i].hour == 16){
              this.sixtnStyle = true;
              this.unavaible.push(16);
            }
            else if(this.reservedhours[i].hour == 17){
              this.svntnStyle = true;
              this.unavaible.push(17);
            }
            else if(this.reservedhours[i].hour == 18){
              this.eightnStyle = true;
              this.unavaible.push(18);
            }
            else if(this.reservedhours[i].hour == 19){
              this.ninetnStyle = true;
              this.unavaible.push(19);
            }
            else if(this.reservedhours[i].hour == 20){
              this.twentyStyle = true;
              this.unavaible.push(20);
            }
          }
        }
      }
      }).catch(error => {
        console.log(error)
      });

      for (var k = 0; k < this.desiredHours.length; k++) {
        for (var i = 0; i < this.unavaible.length; i++) {
          if(this.desiredHours[k] == this.unavaible[i]){
            this.message = "Ezeket az idopontokat valaki mar lefoglalta!";
            this.showfail = true;
            break;
          }
          else{
            this.validated = true;
          }
        }
      }

      if(this.validated == true){
        axios.post('./api/createReservation',{
          hour: this.desiredHours,
          year: this.picked.year,
          month: this.picked.month,
          day: this.picked.day,
          players: this.selectedPlayers,
          tel: this.tel,
          note: this.note,
          user_id: this.userID,
        }).then(response => {
            this.showsuccess = true
            this.desiredHours = [];
          }).catch(error => {
              console.log(error)
              this.showfail = true
            });
      }


      }else{
      axios.post('./api/createReservation',{
          hour: this.desiredHours,
          year: this.picked.year,
          month: this.picked.month,
          day: this.picked.day,
          players: this.selectedPlayers,
          tel: this.tel,
          note: this.note,
          user_id: this.userID,
        }).then(response => {
            this.showsuccess = true
            this.desiredHours = [];
          }).catch(error => {
              console.log(error)
              this.showfail = true
            });
        
    }
  }else{
    this.message = "Minden *-al jelolt mezo kitoltese kotelezo!";
    this.showfail = true;
  }
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
}
.calendar_container{
  /*max-width: 1200px;
  margin: 0 auto;*/
  background-color: #e9e9e9;
  padding: 1rem;
  box-shadow: 0px 0px 5px black;
}
.calendar{
  display: flex;
  flex-direction: column;
  margin: 0 auto;
}
.reservationData_container{

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

.hours_container{
  width: 49em;
  border: 3px solid orange;
  display: none !important;
}
.show.hours_container{
  display: flex !important;
}
.hour_container{
  padding: 0.75rem 0;
  background-color: #333;
}
.hour_container:hover{
  background-color: #575656;
}
.hour_container a{
  color: white;
  text-align: center;
  padding: 14px 10px;
  text-decoration: none;
}
.hour_container.is-1{
  width: 7.712%;
  border-right: 2px solid orange;
}
.info{
  display: none;
  font-size: 19px;
  font-weight: bold;
}
.selectedday{
  color:#000;
}
.messagetext{
  color:#f00;
}
.show.info{
  display: block;
}
.textarea_container{
  width: 30em;
}
.button_container{
  width:200px;
  padding: 1rem;
  display: none;
}
.show.button_container{
  display: block;
}
.form{
  padding: .5rem;
}
.players{
  display: flex;
  font-size: 19px;
}
.tel{
  width: 14rem;
  display: flex;
  font-size: 19px;
}
.note p{
  font-size: 19px;
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

.select{
  width: 5rem;
}
</style>