<?php
include('header.php');
?>
<div class="grid_10">
    <div class="grid ">
        <h2 class="h2">Mailing Lists</h2>
        <hr size="1"class="hr"/>
        <p class="p">Mailing list archives can be found <a href="https://cobug.org/archive/"class="link"data-ajax="false">here.</a><br class="br"/>The following mailing lists are available for public use:</p>
        <ul class="list">
            <li class="listitem"><b>announce@</b> Used for announcements primarily pertaining to CoBUG, but occasionally general BSD announcements as well.</li>
            <li class="listitem"><b>talk@</b> General discussion.</li>
            <li class="listitem"><b>tech@</b> Technical discussion for various BSD project related topics.</li>
        </ul>
        <h3 class="h3">Subscribing / Unsubscribing to the list:</h3>
        <table border="0"class="table">
            <tbody>
                <tr class="tablerow">
                    <th class="tableheader"align="left"valign="middle"colspan="1"rowspan="1">Action</th>
                    <th class="tableheader"align="left"valign="middle"colspan="1"rowspan="1">Address</th>
                    <th class="tableheader"align="left"valign="middle"colspan="1"rowspan="1">Description</th>
                </tr>
                <tr class="tablerow">
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Subscribe</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">&lt;listname&gt;+subscribe@cobug.org</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Subscribes you to the specified &lt;listname&gt;.</td>
                </tr>
                <tr class="tablerow">
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Subscribe Digest</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">&lt;listname&gt;+subscribe-digest@cobug.org</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Subscribes you to the digest version of specified &lt;listname&gt;.</td>
                </tr>
                <tr class="tablerow">
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Unsubscribe</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">&lt;listname&gt;+unsubscribe@cobug.org</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Unsubscribes you from the specified &lt;listname&gt;.</td>
                </tr>
                <tr class="tablerow">
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Help</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">&lt;listname&gt;+help@cobug.org</td>
                    <td class="tablecell"align="left"valign="middle"colspan="1"rowspan="1">Sends you a brief email describing all the available mailing list commands.</td>
                </tr>
            </tbody>
        </table>
        <h3 class="h3">List Netiquette</h3>
        <ol class="list">
            <li class="listitem">Don't be a jerk.</li>
            <li class="listitem">Ask well thought-out questions.</li>
            <li class="listitem">Bottom respond (some people still use things like <b>mutt</b> and <b>pine</b></li>
            <li class="listitem">Advertising is strictly prohibited unless it's for a sanctioned BSD event!</li>
        </ol>
<?php
include('footer.php');
?>
