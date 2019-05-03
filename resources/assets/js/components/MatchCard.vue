<template>
	<div class="matches_container">
          <div class="match_card" v-for="match in card.slice(m,n)">
              <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Eredmény </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.result}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Helyezés </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.placed}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Pontszám </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.score}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Leadott lövések </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.all_shot}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Találatok </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.all_hit}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Pontosság </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.acc}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Bónuszpontok </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.bonus}}</span>
                </div>
                <div class="tags has-addons is-marginless">
                  <span class="tag is-dark is-medium first_tag_history">Dátum </span>
                  <span class="tag is-info is-medium second_tag_history">{{match.match_date}}</span>
                </div>
            </div>
          </div>
</template>
<script>
export default{
	props: {
		card: {
			type: Array, //checking type, if it's not array, make error in console
			required: true
		},
		n: {
			type: Number,
			required: true
		},
		m: {
			type: Number,
			required: true
		}
	},
		data(){
			return {
				itemsPerRow: 4,
			}
		},
		mounted() {
		},
		methods: {
		},
		computed: {
		},
		created() {
		}
	}
</script>
<style>
.first_tag_history{
	width: 8em;
}
.second_tag_history{
	width: 6em;
}
.match_card{
	background-color: #1b6f96;
 	height: 330px;
 	width: 15em; 
 	box-shadow: 0px 0px 5px black;
 	border-radius: 13px;
 	margin-left: 1em;
 	margin-bottom: 1em;
 	padding: .5em;
 	float:left;
}
.matches_container{

}
</style>