
export interface LoginRequest
{
    email: string,
    password: string 
}

export interface RegisterRequest
{
    email: string,
    password: string,
    name: string,
    rol: string,
    age: number,
    classes: []
}

export interface UserResponse
{
    accessToken: string,
    user: {
        email:string,
        name:string,
        rol:string,
        age:number,
        id: number
        classes: []
    }
}
