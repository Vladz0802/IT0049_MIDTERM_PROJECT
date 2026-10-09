<?php $active = 'about'; ?>
<?= $this->include('layouts/header') ?>

<div class="about-grid">
    <section>
        <h1>Built for the counter, not a data center</h1>
        <p>
            Corner Shop POS started as a notebook under the register — a
            running list of regular customers and the staff taking shifts.
            This project turns that notebook into a small web app, one page
            at a time, so the store can eventually track sales without
            losing the simplicity that made the notebook work in the first
            place.
        </p>
        <p>
            The finished system keeps products, customers, staff, and sales in
            a MySQL database. Staff log in to record a sale; each sale takes
            the sold units out of stock and is refused if there aren't enough.
        </p>
    </section>
    <aside>
        <h2>At a glance</h2>
        <ul class="fact-list">
            <li><span class="k">Framework</span><span class="v">CodeIgniter 4</span></li>
            <li><span class="k">Data source</span><span class="v">MySQL database</span></li>
            <li><span class="k">Modules</span><span class="v">Products, Customers, Staff, Sales</span></li>
            <li><span class="k">Access</span><span class="v">Staff login required</span></li>
        </ul>
    </aside>
</div>

<?= $this->include('layouts/footer') ?>
