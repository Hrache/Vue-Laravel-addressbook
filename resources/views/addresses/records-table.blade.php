@extends('layouts.app')

@section('content')

<table class="container">
  <caption><h3>List of the items in the Address Book.</h3></caption>
  <thead>
    <tr>
      <th onclick="sortTable(0)">Id</th>
      <th onclick="sortTable(1)">First name</th>
      <th onclick="sortTable(2)">Last name</th>
      <th onclick="sortTable(3)">Email</th>
      <th onclick="sortTable(4)">Secondary email</th>
      <th onclick="sortTable(5)">Facebook account</th>
      <th onclick="sortTable(6)">Primary phone</th>
      <th onclick="sortTable(7)">Secondary phone</th>
      <th onclick="sortTable(8)">City</th>
      <th onclick="sortTable(9)">Country</th>
      <th onclick="sortTable(10)">Street</th>
      <th onclick="sortTable(11)">House/appartment</th>
      <th onclick="sortTable(12)">Alternative address</th>
      <th></th>
    </tr>
  </thead>

@if ($addresses->count())
  <tbody>
  @foreach ($addresses as $address)
    <tr>
      <td>{{ $address->id }}</td>
      <td>{{ $address->first_name }}</td>
      <td>{{ $address->last_name }}</td>
      <td>{{ $address->email }}</td>
      <td>{{ $address->sec_email }}</td>
      <td>{{ $address->fb_account_url }}</td>
      <td>{{ $address->prim_phone }}</td>
      <td>{{ $address->sec_phone }}</td>
      <td>{{ $address->city }}</td>
      <td>{{ $address->country }}</td>
      <td>{{ $address->street }}</td>
      <td>{{ $address->home }}</td>
      <td>{{ $address->address2 }}</td>
      <td>
        <form action="{{ route('addresses.destroy', ['address' => $address]) }}" class="btn btn-group" method="POST">
          @csrf
          @method('delete')
          <input class="btn" type="submit" value="&#9932;" title="Destroy record #{{ $address->id }}" />
          <a class="btn" href="{{ route('addresses.edit', ['address' => $address]) }}" title="Edit record #{{ $address->id }}">&#9874;</a>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
    <tr><td colspan="14">{{ $addresses->links() }}</td></tr>
  </tfoot>
@endif
</table>
@endsection

@push('bodyground')
<script type="text/javascript">
 function sortTable(n) {

  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;

  // Set the sorting direction to ascending:
  dir = "asc"; 

  /* Make a loop that will continue until no switching has been done: */
  while (switching) {
    // start by saying: no switching is done:
    switching = false;
    rows = table.rows;

    /* Loop through all table rows (except the first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {

      // start by saying there should be no switching:
      shouldSwitch = false;

      /* Get the two elements you want to compare, one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      /* check if the two rows should switch place, based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }

    if (shouldSwitch) {
      /* If a switch has been marked, make the switch and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;

      // Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /* If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
@endpush