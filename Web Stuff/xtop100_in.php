<?php
/*
+---------------------------------------------------------------------------
|   ========================================
|   by Janvier123
|   http://www.dkunderground.org/
|   ========================================
+---------------------------------------------------------------------------
|   THIS IS NOT FREE SOFTWARE!
+---------------------------------------------------------------------------
|   > $Version: 1
|   > $Date: 13 June 2013
+---------------------------------------------------------------------------
*/

function getElementsByClassName(DOMDocument $domNode, $className,$tagType='*')
{
	$matches = array();
	$elementList = $domNode->getElementsByTagName($tagType);
	foreach($elementList as $element)
	{
		if ($element->hasAttribute('class'))
		{
			$classes = explode(' ',$element->getAttribute('class'));
			if (in_array($className, $classes))
			{
				$matches[] = $element;
			}
		}
	}
	return $matches;
}

function getPreviousSiblingTag($element,$tagName)
{
	$result = $element->previousSibling;
	while (isset($result) && ((get_class($result) != 'DOMElement' ) || ($result->tagName != $tagName)))
	{
		$result=$result->previousSibling;
	}
	return $result;
}

function getStats($url,$siteId)
{
	$document = new DOMDocument();
	@$document->loadHTMLFile($url);
	$statsList = getElementsByClassName($document,'stats1','td');
	foreach ($statsList as $statsTD)
	{
		$checkTD = getPreviousSiblingTag($statsTD,'td');
		if (isset($checkTD))
		{
			$anchorList = $checkTD->getElementsByTagName('a');
			foreach ($anchorList as $anchor)
			{
				$testHREF = $anchor->getAttribute('href');
				if (strpos($testHREF,(string) $siteId) > 0 )
				{
					$spanList = $statsTD->getElementsByTagName('span');
					foreach ($spanList as $span)
					{
						if (get_class($span->firstChild) == 'DOMText')
						{
							if (is_numeric($span->textContent)) 
							{
								return $span->textContent;
							}
						}
					}
				}
			}
		}
	}
	return false;
}
echo getStats('http://www.xtremetop100.com/dekaron',1132338702);

?>