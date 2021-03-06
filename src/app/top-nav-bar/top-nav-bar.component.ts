import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
  selector: 'app-top-nav-bar',
  templateUrl: './top-nav-bar.component.html',
  styleUrls: ['./top-nav-bar.component.css', '../bootstrap/bootstrap.css']
})
export class TopNavBarComponent implements OnInit {
  //These just need to be declared for the production buid, they aren't used...
  searchValue;
  ExactSearchValue;
  NarValue;
  hadithNumberValue;
  hadNumberValue;
  chapterNumberValue;
  bookNumberValue;
  
  constructor() { }

  ngOnInit() {
  }

  onFlagChange(e) : void {
	if (e){ 
	$("#non-exact").show()
		$("#exact").hide()
	}
	else {
		$("#non-exact").hide()
		$("#exact").show()		
	}
  }
  getValueBook() : String {
	var book = $("#exact-book-filter").find(":selected").text();
	if (book == "Al-Kafi") { book = "al-kafi"; } //Match database name
	return book;
  }
  getValueHadithNum() : String { //Got by absolute hadith number
	return $("#exact-number-filter").val();
  }
  
  ngAfterViewInit(): void {
	  //Prevent drop-down closing on click inside
	$('.dropdown-menu').on("click.bs.dropdown", function (e) { e.stopPropagation(); e.preventDefault(); });
	
	$("#search-nonexact").keyup(function(event) { if (event.keyCode === 13) { $("#btn-nonexact").click(); } });
	$("#search-narrated-filter").keyup(function(event) { if (event.keyCode === 13) { $("#btn-exact").click(); } });
	$("#search-exact-filter").keyup(function(event) { if (event.keyCode === 13) { $("#btn-exact").click(); } });	
  } 
}
