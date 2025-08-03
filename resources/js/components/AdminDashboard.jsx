import * as Tabs from '@radix-ui/react-tabs';
import * as Dialog from '@radix-ui/react-dialog';

export default function AdminDashboard() {
    return (
        <div className="p-4">
            <Tabs.Root className="TabsRoot" defaultValue="users">
                <Tabs.List className="flex space-x-4 mb-4">
                    <Tabs.Trigger value="users">Users</Tabs.Trigger>
                    <Tabs.Trigger value="posts">Posts</Tabs.Trigger>
                </Tabs.List>

                <Tabs.Content value="users">
                    <h2 className="text-xl mb-2">Manage Users</h2>
                    {/* Example user data */}
                </Tabs.Content>
                <Tabs.Content value="posts">
                    <h2 className="text-xl mb-2">Manage Posts</h2>
                    {/* Example post data */}
                </Tabs.Content>
            </Tabs.Root>

            <Dialog.Root>
                <Dialog.Trigger className="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Open Modal</Dialog.Trigger>
                <Dialog.Portal>
                    <Dialog.Overlay className="fixed inset-0 bg-black opacity-40" />
                    <Dialog.Content className="fixed bg-white p-6 rounded-md shadow-lg left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <Dialog.Title className="text-lg font-bold mb-2">Confirm Action</Dialog.Title>
                        <Dialog.Description className="mb-4">Are you sure you want to delete?</Dialog.Description>
                        <Dialog.Close className="px-4 py-2 bg-red-500 text-white rounded">Close</Dialog.Close>
                    </Dialog.Content>
                </Dialog.Portal>
            </Dialog.Root>
        </div>
    );
}

