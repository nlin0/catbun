
<div class="filter-form">
    <h2>Tags</h2>
    <form id="request-form" action="<?php echo $page_location ?>" method="post" novalidate>

        <div class="input-container">
            <label class ="filter-label" for="request-landscape"> Landscape </label>
            <input type="checkbox" name="name" id="request-landscape" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-portrait"> Portrait </label>
            <input type="checkbox" name="name" id="request-portrait" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-nonhuman"> Nonhuman </label>
            <input type="checkbox" name="name" id="request-nonhuman" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-human"> Human </label>
            <input type="checkbox" name="name" id="request-human" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-painting"> Painting </label>
            <input type="checkbox" name="name" id="request-painting" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-digital"> Digital </label>
            <input type="checkbox" name="name" id="request-digital" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-traditional"> Traditional </label>
            <input type="checkbox" name="name" id="request-traditional" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-sketch"> Sketch </label>
            <input type="checkbox" name="name" id="request-sketch" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-rendered"> Rendered </label>
            <input type="checkbox" name="name" id="request-rendered" checked>
        </div>

        <div class="input-container">
            <label class ="filter-label" for="request-fanart"> Fanart </label>
            <input type="checkbox" name="name" id="request-fanart" checked>
        </div>

        <div class="button">
            <button id="request-submit" type="submit" name="request">Filter</button>
        </div>
    </form>
</div>
