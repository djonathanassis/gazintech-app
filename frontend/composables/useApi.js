import { useCookie } from "#app";

function useBaseApi(path, options = {}) {
    let headers = {};
    const config = useRuntimeConfig()

    const token = useCookie("XSRF-TOKEN");
    if (token.value) {
        headers["X-XSRF-TOKEN"] = token.value;
    }

    return useFetch(path, {
        baseURL: config.public.apiBase,
        credentials: "include",
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...(options && options.headers),
        },
    });
}

export async function useApi(path, options = {}) {
    const token = useCookie("XSRF-TOKEN");
    if (!token.value) {
        await useBaseApi("/sanctum/csrf-cookie");
    }

    return useBaseApi(path, options);
}

export async function useGet(path, options = {}) {
    return await useApi(path, { method: "GET", ...options });
}

export async function usePost(path, options = {}) {
    return await useApi(path, { method: "POST", ...options });
}

export function usePut(path, options = {}) {
    return useApi(path, { method: "PUT", ...options });
}

export function useDelete(path, options = {}) {
    return useApi(path, { method: "DELETE", ...options });
}
