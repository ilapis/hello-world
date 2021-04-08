<div id="menu_top" style="height:3rem;width:100%;border-bottom: 1px solid #CCCCCC;"></div>

<ul id="tabs" class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#nav-home">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#nav-profile">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#nav-contact">Link</a>
    </li>
</ul>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        fff
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        ddd
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        hhh
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var triggerTabList = [].slice.call(document.querySelectorAll('#tabs a'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    }, false);
</script>

<style>
    #menu_top {
        border-bottom: 0 !important;
    }
    #menu_top + .nav.nav-tabs {
        margin-left: -1px;
        margin-top: -1px;
    }
</style>