{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="indexmain">
            <div id="indextop">
                <div id="indexheader">
                    OUR ESCORT DIRECTORIES
                </div>
            </div>
            {% for o in oursites %}
            <div id="indexcontentsites">
                <a href="{{ o['www'] }}" target="_blank"><img src="{{ o['image'] }}" alt="Escort {{ wcountry }}" /></a>
            </div>
            {% endfor %}
            <br />
        </div>
    </div>
</div>