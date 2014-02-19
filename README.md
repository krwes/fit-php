fit-php
=======

A PHP class to encode and decode Garmin .FIT files, based on the FIT SDK.
The FIT SDK can be found at: http://www.thisisant.com/resources/fit

This module will help you read and write binary .FIT files. FIT is the standard format 

Example

<pre style="background:#000;color:#f8f8f8">&lt;?php
<span style="color:#aeaeae;font-style:italic">//Create some data, always set a message 'file_id'.</span>
<span style="color:#3e87e3">$time</span> <span style="color:#e28964">=</span> <span style="color:#dad085">time</span>() <span style="color:#e28964">-</span> <span style="color:#dad085">mktime</span>(<span style="color:#3387cc">0</span>,<span style="color:#3387cc">0</span>,<span style="color:#3387cc">0</span>,<span style="color:#3387cc">12</span>,<span style="color:#3387cc">31</span>,<span style="color:#3387cc">1989</span>);
<span style="color:#3e87e3">$data</span> <span style="color:#e28964">=</span> <span style="color:#e28964">new</span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Data</span>;
<span style="color:#3e87e3">$data</span><span style="color:#e28964">-></span>setFile(\<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">FileType</span><span style="color:#e28964">::</span><span style="color:#3387cc">activity</span>);
<span style="color:#3e87e3">$data</span>
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'file_id'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'type'</span>                  <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">FileType</span><span style="color:#e28964">::</span><span style="color:#3387cc">activity</span>,
        <span style="color:#65b042">'manufacturer'</span>          <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Manufacturer</span><span style="color:#e28964">::</span><span style="color:#3387cc">development</span>,
        <span style="color:#65b042">'product'</span>               <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
        <span style="color:#65b042">'serial_number'</span>         <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
        <span style="color:#65b042">'time_created'</span>          <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span>,
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'activity'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span>,
        <span style="color:#65b042">'num_sessions'</span>          <span style="color:#e28964">=></span> <span style="color:#3387cc">1</span>,
        <span style="color:#65b042">'type'</span>                  <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Activity</span><span style="color:#e28964">::</span><span style="color:#3387cc">manual</span>,
        <span style="color:#65b042">'event'</span>                 <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Event</span><span style="color:#e28964">::</span><span style="color:#3387cc">workout</span>,
        <span style="color:#65b042">'event_type'</span>            <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">EventType</span><span style="color:#e28964">::</span><span style="color:#3387cc">start</span>,
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'event'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span>,
        <span style="color:#65b042">'event_type'</span>            <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">EventType</span><span style="color:#e28964">::</span><span style="color:#3387cc">start</span>,
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'session'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'sport'</span>                 <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Sport</span><span style="color:#e28964">::</span><span style="color:#3387cc">cycling</span>,
        <span style="color:#65b042">'sub_sport'</span>             <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">SubSport</span><span style="color:#e28964">::</span><span style="color:#3387cc">spin</span>,
        <span style="color:#65b042">'total_elapsed_time'</span>    <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
        <span style="color:#65b042">'total_timer_time'</span>      <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
        <span style="color:#65b042">'total_distance'</span>        <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
        <span style="color:#65b042">'total_ascent'</span>          <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>,
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'record'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span><span style="color:#e28964">++</span>, 
        <span style="color:#65b042">'position_lat'</span>          <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'position_long'</span>         <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'altitude'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'heart_rate'</span>            <span style="color:#e28964">=></span> <span style="color:#3387cc">65</span>, 
        <span style="color:#65b042">'cadence'</span>               <span style="color:#e28964">=></span> <span style="color:#3387cc">45</span>, 
        <span style="color:#65b042">'distance'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'power'</span>                 <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'temperature'</span>           <span style="color:#e28964">=></span> <span style="color:#3387cc">19</span>, 
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'record'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span><span style="color:#e28964">++</span>, 
        <span style="color:#65b042">'position_lat'</span>          <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'position_long'</span>         <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'altitude'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'heart_rate'</span>            <span style="color:#e28964">=></span> <span style="color:#3387cc">70</span>, 
        <span style="color:#65b042">'cadence'</span>               <span style="color:#e28964">=></span> <span style="color:#3387cc">90</span>, 
        <span style="color:#65b042">'distance'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">10</span>, 
        <span style="color:#65b042">'power'</span>                 <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'temperature'</span>           <span style="color:#e28964">=></span> <span style="color:#3387cc">19</span>, 
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'record'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span><span style="color:#e28964">++</span>, 
        <span style="color:#65b042">'position_lat'</span>          <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'position_long'</span>         <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'altitude'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'heart_rate'</span>            <span style="color:#e28964">=></span> <span style="color:#3387cc">73</span>, 
        <span style="color:#65b042">'cadence'</span>               <span style="color:#e28964">=></span> <span style="color:#3387cc">90</span>, 
        <span style="color:#65b042">'distance'</span>              <span style="color:#e28964">=></span> <span style="color:#3387cc">20</span>, 
        <span style="color:#65b042">'power'</span>                 <span style="color:#e28964">=></span> <span style="color:#3387cc">0</span>, 
        <span style="color:#65b042">'temperature'</span>           <span style="color:#e28964">=></span> <span style="color:#3387cc">19</span>, 
    ))
    <span style="color:#e28964">-></span>add(<span style="color:#65b042">'event'</span>, <span style="color:#dad085">array</span>(
        <span style="color:#65b042">'timestamp'</span>             <span style="color:#e28964">=></span> <span style="color:#3e87e3">$time</span>,
        <span style="color:#65b042">'event_type'</span>            <span style="color:#e28964">=></span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">EventType</span><span style="color:#e28964">::</span><span style="color:#3387cc">stop</span>,
    ))
;

<span style="color:#3e87e3">$debug</span> <span style="color:#e28964">=</span> <span style="color:#3387cc">true</span>;

<span style="color:#aeaeae;font-style:italic">//Write the data</span>
<span style="color:#3e87e3">$fitwriter</span> <span style="color:#e28964">=</span> <span style="color:#e28964">new</span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Writer</span>(<span style="color:#3e87e3">$debug</span>);
<span style="color:#3e87e3">$filepath</span> <span style="color:#e28964">=</span> <span style="color:#3e87e3">$fitwriter</span><span style="color:#e28964">-></span>writeData(<span style="color:#3e87e3">$data</span>);

<span style="color:#aeaeae;font-style:italic">//Read the data that was just created</span>
<span style="color:#3e87e3">$fit</span> <span style="color:#e28964">=</span> <span style="color:#e28964">new</span> \<span style="color:#9b859d">Fit</span>\<span style="color:#9b859d">Reader</span>(<span style="color:#3387cc">true</span>);
<span style="color:#3e87e3">$fit</span><span style="color:#e28964">-></span>parseFile(<span style="color:#3e87e3">$filepath</span>, <span style="color:#3e87e3">$debug</span>);

<span style="color:#aeaeae;font-style:italic">//Delete the written data</span>
<span style="color:#dad085">unlink</span>(<span style="color:#3e87e3">$filepath</span>);

<span style="color:#aeaeae;font-style:italic">//output the resulting data</span>
<span style="color:#dad085">echo</span> <span style="color:#65b042">'&lt;pre>'</span>;
<span style="color:#dad085">var_dump</span>(<span style="color:#3e87e3">$fit</span>);
<span style="color:#dad085">echo</span> <span style="color:#65b042">'&lt;/pre>'</span>;


</pre>


