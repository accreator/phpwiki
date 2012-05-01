<html>
<head>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/dojo/1.6.0/dojo/dojo.xd.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/diffview.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/css/diffview.css"/>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/difflib.js"></script>


<script language="javascript">
var $ = dojo.byId;
var url = window.location.toString().split("#")[0];

function diffUsingJS () {
	var base = difflib.stringAsLines($("baseText").value);
	var newtxt = difflib.stringAsLines($("newText").value);
	var sm = new difflib.SequenceMatcher(base, newtxt);
	var opcodes = sm.get_opcodes();
	var diffoutputdiv = $("diffoutput");
	while (diffoutputdiv.firstChild) diffoutputdiv.removeChild(diffoutputdiv.firstChild);
	var contextSize = $("contextSize").value;
	contextSize = contextSize ? contextSize : null;
	diffoutputdiv.appendChild(diffview.buildView({ baseTextLines:base,
												   newTextLines:newtxt,
												   opcodes:opcodes,
												   baseTextName:"Base Text",
												   newTextName:"New Text",
												   contextSize:contextSize,
												   viewType: $("inline").checked ? 1 : 0 }));
	window.location = url + "#diff";
}
</script>
</head>
<body>
	<h1><a href="http://github.com/cemerick/jsdifflib">jsdifflib</a> demo</h1>
	<strong>Context size (optional):</strong> <input type="text" id="contextSize" value=""></input><br/>
	<strong>Diff View Type:</strong>
	<input type="radio" name="_viewtype" checked="checked" id="sidebyside"/> Side by Side
	&#160;&#160;
	<input type="radio" name="_viewtype" id="inline"/> Inline
	<h2>Base Text</h2>
	<textarea id="baseText" style="width:600px;height:300px"></textarea><br/>
	<h2>New Text</h2>
	<textarea id="newText" style="width:600px;height:300px"></textarea><br/><br/>
	<input type="button" value="Diff" onclick="javascript:diffUsingJS();"/><br/><br/>
	<a name="diff"> </a>
	<div id="diffoutput" style="width:100%"> </div>
</body>
</html>
