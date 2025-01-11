<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
echo '<center><table><tr></tr><td class=header>IRChat</td><tr><td style=padding-top:30px;><iframe width="550" height="450"src="http://widget.mibbit.com/?settings=796924f84fa324a18252d15a87df9134&server=irc.tddirc.net&channel=%23alphadekaron"></iframe></td></tr></center>';

?>