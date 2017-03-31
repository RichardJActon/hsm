$(document).ready(function()
{
	/*
	# search.js
	## Dependencies
	- Direct
	  - jQuery(v3.1.1)
	  - typeahead(v0.11.1) bundle including bloodhound	
    - Indirect
	  - bootstrap.css (v3.3.7)
      - bootstrap.js (3.3.7)
	  - hsm.css

	## SNP
	### Description
	object containing data to specify the different types of search.
	- actionURL: url to be placed in the action attribute of the search form.
	- btnID: ID of the button used to switch the search mode.
	- name: name of the field in the GET to be sent with the actionURL.
	- placeholder: what to display in the search box prior to user input.
	- label: label for the search box for a screen reader.
	- searchURL: URL of the page which returns search suggestions as JSON.
	*/
	var searchTypes = 
	{
		"SNP":
		{
			"actionURL":"result.php?searchTerm",
			"btnID":"#SNP-btn",
			"name":"searchTerm",
			"placeholder":"e.g. rs6025",
			"label":"SNP search",
			"searchURL":"./src/snp_id_search.php?query"
		},
		"gene":
		{
			"actionURL":"gene.php?gene",
			"btnID":"#gene-btn",
			"name":"gene",
			"placeholder":"e.g. TERT",
			"label":"Gene search",
			"searchURL":"./src/gene_search.php?query"
		},
		"GWAS":
		{
			"actionURL":"annotation.php?annotation",
			"btnID":"#GWAS-btn",
			"name":"annotation",
			"placeholder":"e.g. obesity",
			"label":"GWAS disease/phenotype search",
			"searchURL":"./src/GWASsearch.php?query"
		},
		"coord":
		{
			"actionURL":"posSearch.php?posSearch",
			"btnID":"#coord-btn",
			"name":"posSearch",
			"placeholder":"e.g. chr1:1000:2000",
			"label":"Genomic coordinates search",
			"searchURL":"./src/CoordSearch.php?query"
		}
	};
	
	/*## Search() function
	### Args
	- $searchURL: the URL of the page with returns search suggestions as JSON object when provided with the query.

	### Returns
	- none directly.
	- search suggestion are accessible to form of ID searchForm with class typeahead.

	### Description
	uses twitter's typeahead with different remotes depending on the specified URL.

	### Dependencies
	- jQuery(v3.1.1)
	- typeahead(v0.11.1) bundle including bloodhound

	*/
	function Search($searchURL)
	{
		var Suggestions = new Bloodhound(
		{
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: 
			{
				url: $searchURL + '=%QUERY',
				wildcard: '%QUERY'
			}
		});
		$('#searchForm .typeahead').typeahead(null,
		{
			name:'Suggestions',
			display: 'value',
			source: Suggestions
		});
	}

	/*## searchDiv String
	### Description
	Contains the HTML for a the search form with, suggestions and hidden submit button. It has placeholders wrapped in % signs for search type specific content.
	this string is altered by the `searchSet()` function.

	NB - styling requires the hsm.css stylesheet
	*/
	var searchDiv = '<form id="searchForm" class="form-horizontal content" method="get" action="%action%"><div class="form-group"><div><label id="searchLabel" class="sr-only" for="searchInput">%label%</label><input id="searchInput" type="text" class="form-control typeahead" name="%name%" placeholder="%placeholder%"></input><div class="hidden-submit"><input type="submit" tabindex="-1"/></div></div></div></form>'

	/*## `searchSet()` function
	### Args
	- $key: the key of an object in the `searchTypes` object to specify what type of search is to be used.

	### Returns
	- none directly
	- Alters the searchDiv string

	### Description
	Substitutes the values in the `searchDiv` string with those corresponding to the input key. and calls the `Search()` function to set the correct suggestion generator.

	### Dependencies
	- jQuery(v3.1.1)
	- uses `Search()` function.
	*/
	function searchSet($key)
	{
		//if (searchTypes.SNP.btnID ===)
		var tmp = searchDiv.replace("%action%",searchTypes[$key].actionURL);
		tmp = tmp.replace("%label%",searchTypes[$key].label);
		tmp = tmp.replace("%name%",searchTypes[$key].name);
		tmp = tmp.replace("%placeholder%",searchTypes[$key].placeholder);
		$("#searchDiv").empty();
		$("#searchDiv").append(tmp);
		Search(searchTypes[$key].searchURL);
	};
	/*## `searchSet()` function calls
	### default search
	This `searchSet()` function call sets the default search type. The argument is the name of the desired default's corresponding object in `searchTypes` object*/
	searchSet("SNP");
	
	/*### button click dependent `searchSet()` function calls
	Calls `searchSet()` which alters the `searchDiv` string to match the corresponding button and calls `Search()` to connect the search form to the corresponding remote suggestion generator.
	*/
	$(searchTypes.SNP.btnID).click(function(){searchSet("SNP");});
	$(searchTypes.gene.btnID).click(function(){searchSet("gene");});
	$(searchTypes.GWAS.btnID).click(function(){searchSet("GWAS");});
	$(searchTypes.coord.btnID).click(function(){searchSet("coord");});
});
