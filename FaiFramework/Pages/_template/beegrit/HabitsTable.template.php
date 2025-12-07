<div class="ms-auto me-auto w-50 mb-3">
	<div class="text-center h3 strong"> Tanggal Mulai</div>
	<div class="input-group form-nilai">
		<span class="input-group-btn">
			<button type="button" class="btn btn-default btn-number px-2  btn-nr" style="padding-bottom: 11px !important;" data-type="minus" data-field="select_date" onclick="addTblDate(1);loadTable();">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none">
					</path>
					<polyline points="15 6 9 12 15 18">
					</polyline>
				</svg>
			</button>
		</span>
		<input id="select_date" type="date" class="form-control text-center h-75 p-2 input-number" placeholder="" value="NOWDATE" onchange="loadTable()"></input>
		<span class="input-group-btn">
			<button type="button" class="btn btn-default btn-number px-2  btn-nr" style="padding-bottom: 11px !important;" data-type="plus" onclick="addTblDate(-1);loadTable();">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none">
					</path>
					<polyline points="9 6 15 12 9 18">
					</polyline>
				</svg>
			</button>
		</span>
	</div>
</div>
<style>
	.table td,
	.table th {
		border-color: transparent !important;
		padding-left: 15px;
	}

	.table-scroll thead th {
		background: #333;
		color: #fff;
		position: -webkit-sticky;
		position: sticky;
		top: 0;
	}

	.table-scroll {
		position: relative;
		width: 100%;
		z-index: 1;
		margin: auto;
		overflow: auto;
		height: 550px;
	}

	.table-scroll table {
		width: 100%;
		min-width: 1280px;
		margin: auto;
		border-collapse: separate;
		border-spacing: 0;
	}

	.table-wrap {
		position: relative;
	}

	.table-scroll th,
	.table-scroll td {
		padding: 5px 10px;
		border: 1px solid #000;
		background: #fff;
		vertical-align: top;
	}

	.table-scroll thead th {
		background: #333;
		color: #fff;
		position: -webkit-sticky;
		position: sticky;
		top: 0;
	}

	/* safari and ios need the tfoot itself to be position:sticky also */
	.table-scroll tfoot,
	.table-scroll tfoot th,
	.table-scroll tfoot td {
		position: -webkit-sticky;
		position: sticky;
		bottom: 0;
		background: #666;
		color: #fff;
		z-index: 4;
	}


	/* testing links*/

	th:first-child {
		position: -webkit-sticky;
		position: sticky;
		/*left: 0;*/
		z-index: 2;
		background: #ccc;
	}

	thead th:first-child,
	tfoot th:first-child {
		z-index: 5;

	}

	.hover-td:hover {
		background: #cacaca !important;
		color: #fff
	}

	.text-success {
		color: #009688 !important;
	}
</style>
<div id="table-scroll" class="table-scroll table-responsive">

</div>

<script>
	loadTable_habits_Table();

</script>