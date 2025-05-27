<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles List') }}
        </h2>
        @can('create roles')
        <a href="{{ route('roles.create')}}" class="bg-slate-700 text-sm rounded-lg text-white px-5 py-2">Create</a>
        @endcan
      </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <x-message></x-message>
                      <table class="w-full ">
              <thead class="bg-gray-50">
                <tr class="border-b">
                  <th class="px-6 py-3 text-left">#</th>
                  <th class="px-6 py-3 text-left">Name</th>
                  <th class="px-6 py-3 text-left">Permissions</th>
                  <th class="px-6 py-3 text-left">Created</th>
                  <th class="px-6 py-3 text-center" width="200">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                @if($roles->isNotEmpty())
                  @foreach($roles as $permission)
                  <tr class="border-b">
                    <td class="px-6 py-3 text-left">{{$permission->id}}</td>
                    <td class="px-6 py-3 text-left">{{$permission->name}}</td>
                    <td class="px-6 py-3 text-left">{{$permission->permissions->pluck('name')->implode(', ')}}</td>
                    <td class="px-6 py-3 text-left">{{ \Carbon\Carbon::parse($permission->created_at)->format('d,M,Y')}}</td>
                    <td class="px-6 py-3 text-center" width="200">
                      @can('edit roles')
                      <a href="{{ route('roles.edit',$permission->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                      @endcan
                      @can('delete roles')
                      <a href="javascript:void(0);" onClick="deleteRole({{$permission->id}})" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">Delete</a>
                      @endcan
                    </td>
                </tr>
                  @endforeach
                @endif
                
              </tbody>
            </table>
        </div>
         <div class="my-3">
          {{$roles->links() }}
        </div>
    </div>
    <x-slot name="script">
    <script type="text/javascript">
      function deleteRole(id) {
        if(confirm('Are you sure you want to delete?')) {
          $.ajax({
            url:'{{route("roles.destroy")}}',
            type:'delete',
            data:{id:id},
            headers:{
              'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            success:function(data) {
              window.location.href='{{ route("roles.index") }}'
            }
          })
        }
      }
    </script>
  </x-slot>
</x-app-layout>