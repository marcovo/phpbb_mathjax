/*!
 * MathJax phpBB Integration
 * copyright (c) 2014 Sérgio Faria and Marco van Oort
 * license http://opensource.org/licenses/gpl-license.php GNU Public License v2
 */

function phpbb2jax()
{
	var list = getElementsByClassName("MathJaxBB", "span");

	for (i = 0, n = list.length; i < n; ++i)
	{
		var item = list[i];

		for (j = 0, m = item.childNodes.length; j < m; j++)
		{
			var child = item.childNodes[j];
			var type = child.className;

			if (type == "math/tex" || type == "math/mml")
			{
				var script = document.createElement("script");
				script.type = type;
				MathJax.HTML.setScript(script, getText(child));

				item.replaceChild(script, child);
				MathJax.Hub.Queue(["Process", MathJax.Hub, item]);
			}
		}
	}
}

function getElementsByClassName(className, tag)
{ 
	if (document.getElementsByClassName)
	{
		return document.getElementsByClassName(className);
	} 
	else 
	{
		// fallback
		var list = new Array();
		if (!tag)
		{
			tag = "*";
		}
		var ele = document.getElementsByTagName(tag);
		var eleLen = ele.length;
		var pattern = new RegExp("(^|\\s)" + className + "(\\s|$)");
		
		for (i = 0, j = 0; i < eleLen; i++)
		{
			if (ele[i].className && pattern.test(ele[i].className))
			{
				list[j] = ele[i];
				j++;
			}
		}
		return list;
	}
}

function getText(node)
{
	// Test textContent because Chrome returns an empty string on innerText
	if(node.textContent !== undefined)
	{
		return node.textContent;
	}
	return node.innerText; // IE
}
